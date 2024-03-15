<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()

    {
        $products = Product::all();
        return view('dashboard-views.dashboard', compact('products'));
    }

    public function showProducts()
    {
        return view('dashboard-views.dashboard-products');
    }




}
