<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class EatHereController extends Controller
{

    public function comprarProducto($id)
    {
        $product = Product::find($id);
        $product->availability = false;
        $product->save();
        return redirect()->route('prueba');
    }

    public function eatHere(){
        $categorys = DB::select('select category from products group by category');

        // Array para almacenar los productos por categoría
        $productsByCategory = [];


        foreach ($categorys as $category) {
            // Consultar los productos asociados a la categoría actual
            $products = DB::select('select * from products where category = ?', [$category->category]);

            // Almacenar los productos en el array asociativo
            $productsByCategory[$category->category] = $products;
        }


        return view('user-views.menu',
        ['productsByCategory' => $productsByCategory,
        'takeAway' => 0]);
    }
}
