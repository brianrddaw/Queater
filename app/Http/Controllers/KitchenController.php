<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\OrderController;

class KitchenController extends Controller
{
    public function index()
    {
        $orderController = new OrderController();

        $preparingOrderJson = $orderController->preparingOrderJson();
        $readyOrdersJson = $orderController->getReadyOrders();
        return view('kitchen-views.kitchen', [
            'preparingOrders' => $preparingOrderJson,
            'readyOrders' => $readyOrdersJson
        ]);
    }

    public function sendNewOrders()
    {
        $ordersData = Order::with('ordersLine.product')
        ->where('state', 'new')
        ->orderby('created_at', 'desc')
        ->get();

        foreach ($ordersData as $order) {
            $order->state = 'preparing';
            $order->save();
        }

        $orderController = new OrderController();
        $ordersJson = $orderController->formatOrdersData($ordersData);
        return response()->json($ordersJson);
    }

    public function sendReadyOrders()
    {
        $ordersData = Order::with('ordersLine.product')
                        ->where('created_at', '>=', now()->subHours(24))
                        ->where('state', 'ready')
                        ->orderby('created_at', 'desc')
                        ->get();

        $orderController = new OrderController();
        $ordersJson = $orderController->formatOrdersData($ordersData);

        return response()->json($ordersJson);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->state = 'ready';
        $order->save();

        return response()->json([
            'id' => $order->id,
            'take_away' => $order->take_away,
            'table_id' => $order->table_id,
            'state' => $order->state,
            'created_at' => $order->created_at->toIso8601String(),
            'updated_at' => $order->updated_at->toIso8601String(),
        ]);

    }

}
