<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class EatHereController extends Controller
{

    public function comprarProducto($id)
    {
        $product = Product::find($id);
        $product->availability = false;
        $product->save();
        return redirect()->route('prueba');
    }

    public function index(){

        $products = Product::all();
        return view('user-views.eat-here', ['products' => $products]);
    }
}
