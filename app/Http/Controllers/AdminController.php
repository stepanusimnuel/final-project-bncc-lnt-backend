<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Toy;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titleProducts = "All Toys";

        if(request('search')) {
            $titleProducts = request('search');
        }

        if(request('category')) {
            $category = Category::firstWhere('id', request('category'));
            $titleProducts .= ": $category->name";
        }

        $viewData = [
            "title" => "Petualangan Ceria | Admin",
            "titleProducts" => $titleProducts,
            "toys" => Toy::filter(request(['search', 'category']))->get(),
            "categories" => Category::all()
        ];

        return view('admin.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('toys.create', ['title' => 'Admin | Mainan Baru', "categories" => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'category_id' => 'required',
            'image' => 'required|image|file|max:3072'
        ]);


        if($request->description) {
            $validatedData['description'] = $request->description;
        }

        $validatedData['image'] = $request->file('image')->store('toy-images');

        Toy::create($validatedData);

        return redirect('/admin/toys')->with('success', 'Data mainan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Toy $toy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toy $toy)
    {
        return view('toys.edit', [
            'title' => 'Admin | Edit',
            "categories" => Category::all(),
            'toy' => $toy
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toy $toy)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'category_id' => 'required',
            'image' => 'image|file|max:3072'
        ]);

        if($request->description) {
            $validatedData['description'] = $request->description;
        }

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('toy-images');
        }

        Toy::where('id', $toy->id)
            ->update($validatedData);

        return redirect('admin/toys')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toy $toy)
    {
        if($toy->image) {
            Storage::delete($toy->image);
        }
        Toy::destroy($toy->id);

        return redirect('/admin/toys')->with('success', 'Data berhasil dihapus');
    }
}
