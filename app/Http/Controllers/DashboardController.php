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
        return view('dashboard-views.products', ['products' => $products]);
    }

}
