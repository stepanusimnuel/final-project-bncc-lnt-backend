<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Models\InvoiceHeader;
use App\Models\InvoiceDetail;

class CheckoutController extends Controller
{
    public function index(Request $request) {
        // return json_decode($request->cookie('cart', '[]'), true);
        return view('checkout.index', [
            "cart" => json_decode($request->cookie('cart', '[]'), true)
        ]);
    }

    public function storeOne(Request $request, Toy $toy) {
        $validatedData = $request->validate([
            'quantity' => "required|numeric|min:1|max:$toy->stock"
        ]);

        $subtotal = $toy->price * $validatedData['quantity'];

        if(auth()->user()->money < $subtotal) {
            return redirect('/')->with('error', 'Maaf, uang Anda tidak mencukupi');
        }

        $toy->stock -= $validatedData['quantity'];
        $toy->save();

        auth()->user()->money -= $subtotal;
        auth()->user()->save();

        $invoiceHeader = InvoiceHeader::create([
            "user_id" => auth()->user()->id,
            "total" => $subtotal
        ]);

        InvoiceDetail::create([
            'invoice_header_id' => $invoiceHeader->id,
            'toy_id' => $toy->id,
            'quantity' => $validatedData['quantity'],
            'subtotal' => $subtotal,
        ]);

        return redirect('/')->with('success', 'Mainan berhasil dibeli');
    }

    public function addToCart(Request $request, Toy $toy)
    {
        $request->validate([
            'quantity' => "required|numeric|min:1|max:$toy->stock"
        ]);

        $cart = json_decode($request->cookie('cart', '[]'), true);

        if (isset($cart[$toy->id])) {
            $cart[$toy->id]['quantity'] += $request->quantity;
        } else {
            $cart[$toy->id] = [
                'id' => $toy->id,
                'name' => $toy->name,
                'price' => $toy->price,
                'quantity' => $request->quantity,
            ];
        }

        $cart = json_encode($cart);

        return redirect('/')->withCookie(cookie('cart', $cart, 60*24*30))
            ->with('success', 'Mainan berhasil ditambahkan ke keranjang');
    }

    public function checkout(Request $request) {
        $cart = json_decode($request->cookie('cart', '[]'), true);

        if(empty($cart)) {
            return redirect('/')->with('error', 'Keranjang Anda kosong');
        }

        if(auth()->user()->money < $request->total) {
            return redirect('/')->with('error', 'Maaf, uang Anda tidak mencukupi');
        }

        auth()->user()->money -= $request->total;
        auth()->user()->save();

        $invoiceHeader = InvoiceHeader::create([
            "user_id" => auth()->user()->id,
            "total" => $request->total
        ]);

        foreach($cart as $item) {
            InvoiceDetail::create([
                'invoice_header_id' => $invoiceHeader->id,
                'toy_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            $toy = Toy::findOrFail($item['id']);
            $toy->stock -= $item['quantity'];
            $toy->save();
        }

        return redirect('/')->withCookie(cookie('cart', '', -1))->with('success', 'Checkout berhasil');
    }

    public function removeFromCart(Request $request, Toy $toy) {
        $cart = json_decode($request->cookie('cart', '[]'), true);

        if(empty($cart)) {
            return redirect('/')->with('error', 'Keranjang Anda kosong');
        }

        if(isset($cart[$toy->id])) {
            unset($cart[$toy->id]);
        }

        return redirect('/cart/toys')->withCookie(cookie('cart', json_encode($cart), 60 * 24 * 30))->with('success', 'Mainan berhasil dihapus dari keranjang');

    }
}
