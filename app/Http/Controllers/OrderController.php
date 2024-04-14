<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersLine;

class OrderController extends Controller
{
    public function showCart()
    {
        return view('views.user-views.user-cart.user-cart');
    }

    public function makeOrder(Request $request)
    {
        $order = new Order();
        $order->take_away = $request->takeAway;
        $order->save();

        foreach($request->products as $product)
        {
            $orderLine = new OrdersLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $product['id'];
            $orderLine->quantity = $product['quantity'];
            $orderLine->save();
        }
    }

    public function getOrderByCondition($condition = null)
    {
        $ordersData = Order::with('ordersLine.product')
        ->where('state', '!=', 'ready')
        ->where('state', '!=', 'delivered');

        if (!empty($condition['orderId'])) {
            $ordersData = $ordersData->where('id', $condition['orderId']);
        }

        $ordersData = $ordersData->get();

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
                'state' => $order->state,
                'created_at' => $order->created_at->toIso8601String(),
                'updated_at' => $order->updated_at->toIso8601String(),
                'orders_line' => $orderLines,
            ];
        }

        return $ordersJson;
    }

}
