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
        $ordersJson = $orderController->getOrderByCondition();
        $readyOrdersJson = $orderController->getOrderByCondition(null, true);
        return view('kitchen-views.kitchen', [
            'orders' => $ordersJson, 'readyOrders' => $readyOrdersJson
        ]);
    }

    public function sendNewOrders()
    {
        $ordersData = Order::with('ordersLine.product')
        ->where('state', 'new')
        ->get();

        foreach ($ordersData as $order) {
            $order->state = 'preparing';
            $order->save();
        }
        $ordersJson = [];

        foreach ($ordersData as $order) {
            $orderLines = [];
            foreach ($order->ordersLine as $orderLine) {
                $orderLines[] = [
                    'id' => $orderLine->id,
                    'order_id' => $orderLine->order_id,
                    'product_id' => $orderLine->product_id,
                    'quantity' => $orderLine->quantity,
                    'product' => [
                        'id' => $orderLine->product->id,
                        'name' => $orderLine->product->name,
                        'description' => $orderLine->product->description,
                        'price' => $orderLine->product->price,
                        'image_url' => $orderLine->product->image_url,
                    ]
                ];
            }

            $ordersJson[] = [
                'id' => $order->id,
                'take_away' => $order->take_away,
                'table_id' => $order->table_id,
                'state' => $order->state,
                'created_at' => $order->created_at->toIso8601String(),
                'updated_at' => $order->updated_at->toIso8601String(),
                'orders_line' => $orderLines,
            ];
        }

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
