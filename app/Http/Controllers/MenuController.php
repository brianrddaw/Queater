<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function comprarProducto($id)
    {
        $product = Product::find($id);
        $product->availability = false;
        $product->save();
        return redirect()->route('prueba');
    }

    public function getMenu()
    {
        $productsByCategory = DB::table('products')
        ->join('categorys', 'products.category_id', '=', 'categorys.id')
        ->select('products.*', 'categorys.name as category_name')
        ->where('products.take_away', $takeAway)
        ->get()
        ->groupBy('category_name');
        return $productsByCategory;
    }
}
