<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()

    {

        return view('dashboard-views.dashboard');
    }

    public function showProducts()
    {
        $products = Product::all();
        return view('dashboard-views.dashboard-products',['products' => $products]);
    }


    //Funcion para mostrar las categorias.
    public function showCategories()
    {
        return view('dashboard-views.dashboard-categories');
    }

    //Funcion para mostrar las mesas.
    public function showTables()
    {
        return view('dashboard-views.dashboard-tables');
    }

}
