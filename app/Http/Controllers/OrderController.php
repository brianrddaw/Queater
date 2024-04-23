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
        if ($request->table_number) {
            $order->table_number = $request->table_number;
        }
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

    public function getOrderByCondition($condition = null, $ready_orders = false)
    {
        $ordersData = Order::with('ordersLine.product');

        if (!empty($condition['orderId'])) {
            $ordersData = $ordersData->where('id', $condition['orderId']);
        }

        if (!$ready_orders) {
            $ordersData = $ordersData->where('state', '!=','ready');
        } else {
            $ordersData = $ordersData->where('state', 'ready');
            $ordersData = $ordersData->where('created_at', '>=', now()->subHours(3));
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
                'table_id' => $order->table_id,
                'state' => $order->state,
                'created_at' => $order->created_at->toIso8601String(),
                'updated_at' => $order->updated_at->toIso8601String(),
                'orders_line' => $orderLines,
            ];
        }

        return $ordersJson;
    }

}
