<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($product)
    {
        return view('user-views.user-product.product-card', ['product' => $product]);
    }

    //Funcion para devolver todos los productos en un objeto JSON
    // public function getProducts()
    // {
    //     $products = Product::all();
    //     return view('prueba', ['products' => $products]);
    // }

    //Funcion para crear nuevos productos.
    public function createProduct($name, $description, $price, $category_id, $image_url)
    {
        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category_id;
        $product->image_url = $image_url;
        $product->save();

    }


}
