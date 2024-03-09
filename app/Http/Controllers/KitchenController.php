<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {

        $orders = DB::select('select * from orders where status = ?', ['pending']);



        return view('kitchen-views.kitchen', [
            'urls' => [
                'home' => route('dashboard.main'),
                'menu' => route('eat-here.main'),
                'kitchen' => route('kitchen.main'),
            ]
        ]);
    }

    public function showOrders()
    {
        return view('kitchen-views.kitchen-orders', [
            'urls' => [
                'home' => route('dashboard.main'),
                'menu' => route('eat-here.main'),
                'kitchen' => route('kitchen.main'),
            ],

        ]);
    }


}
