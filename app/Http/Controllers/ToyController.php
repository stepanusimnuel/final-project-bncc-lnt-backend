<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toy;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ToyController extends Controller
{
    public function index() {
        $titleProducts = "All Toys";

        if(request('search')) {
            $titleProducts = request('search');
        }

        if(request('category')) {
            $category = Category::firstWhere('id', request('category'));
            $titleProducts .= ": $category->name";
        }

        $viewData = [
            "title" => "Petualangan Ceria",
            "titleProducts" => $titleProducts,
            "toys" => Toy::filter(request(['search', 'category']))->get(),
            "categories" => Category::all()
        ];

        if(auth()->check() &&  auth()->user()->role === "admin") {
            return redirect('/admin/toys');
        }

        return view('index', $viewData);
    }

    public function show(Toy $toy) {
        return view('toys.detail', [
            "title" => "Detail of $toy->name",
            "isDark" => ($toy->id - 1) % 6 == 0 || ($toy->id - 1) % 6 == 3 || ($toy->id - 1) % 6 == 4 ? true : false,
            "toy" => $toy
        ]);
    }
}
