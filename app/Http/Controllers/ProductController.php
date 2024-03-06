<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //Funcion para devolver todos los productos en un objeto JSON
    public function getProducts()
    {
        $products = Product::all();
        return view('prueba', ['products' => $products]);
    }

    public function comprarProducto($id)
    {
        $product = Product::find($id);
        $product->availability = false;
        $product->save();
        return redirect()->route('prueba');
    }
    
}
