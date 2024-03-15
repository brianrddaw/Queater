<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()

    {
        $products = Product::all();
        $categories = Category::all();
        return view('dashboard-views.dashboard', compact('products' , 'categories'));
    }

    public function showProducts()
    {
        return view('dashboard-views.dashboard-products');
    }




}
