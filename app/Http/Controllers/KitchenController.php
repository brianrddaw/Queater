<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        return view('kitchen-views.kitchen', [
            'urls' => [
                'home' => route('dashboard.main'),
                'menu' => route('eat-here.main'),
                'kitchen' => route('kitchen.main'),
            ]
        ]);
    }
}
