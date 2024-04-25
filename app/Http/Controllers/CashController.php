<?php

namespace App\Http\Controllers;

class CashController extends Controller
{
    public function index()
    {
        $orderController = new OrderController();
        $takeAwayOrders = $orderController->getTakeAwayOrders(true);
        $eatHereOrders = $orderController->getEatHereOrders(true);
        $preparingOrders = $orderController->preparingOrderJson();

        return view('cash-views.cash', [
            'takeAwayOrders' => $takeAwayOrders,
            'eatHereOrders' => $eatHereOrders,
            'preparingOrders' => $preparingOrders,
        ]);
    }
}
