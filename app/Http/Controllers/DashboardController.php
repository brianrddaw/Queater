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
        return view('dashboard-views.dashboard-products');
    }




}
