<?php

namespace App\Http\Controllers;

class CashController extends Controller
{
    public function index()
    {
        $orderController = new OrderController();
        $takeAwayOrders = $orderController->getTakeAwayOrders();
        $eatHereOrders = $orderController->getEatHereOrders();
        $preparingOrders = $orderController->preparingOrderJson();

        return view('cash-views.cash', [
            'takeAwayOrders' => $takeAwayOrders,
            'eatHereOrders' => $eatHereOrders,
            'preparingOrders' => $preparingOrders,
        ]);
    }
}

