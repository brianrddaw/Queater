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

    public function preparingOrderJson()
    {
        $preparingOrderData = Order::where('state', 'preparing')->with('ordersLine.product')->get();
        $preparingOrderJson = $this->_formatOrdersData($preparingOrderData);
        return $preparingOrderJson;
    }

    public function getReadyOrders()
    {
        $readyOrdersData = Order::where('state', 'ready')
                            ->where('created_at', '>=', now()->subHours(48))
                            ->with('ordersLine.product')
                            ->orderby('created_at', 'desc')
                            ->get();
        $readyOrdersJson = $this->_formatOrdersData($readyOrdersData);
        return $readyOrdersJson;
    }

    public function getTakeAwayOrders()
    {
        $takeAwayOrdersData = Order::where('take_away', true)
                                ->with('ordersLine.product')
                                ->where('state', 'preparing')
                                ->orderby('created_at', 'desc')
                                ->get();

        $takeAwayOrdersJson = $this->_formatOrdersData($takeAwayOrdersData);
        return $takeAwayOrdersJson;
    }

    public function getEatHereOrders()
    {
        $eatHereOrdersData = Order::where('take_away', false)
                                ->with('ordersLine.product')
                                ->where('state', 'preparing')
                                ->orderby('created_at', 'desc')
                                ->get();

        $eatHereOrdersJson = $this->_formatOrdersData($eatHereOrdersData);
        return $eatHereOrdersJson;
    }

    private function _formatOrdersData($ordersData)
    {
        $ordersJson = [];
        foreach ($ordersData as $orderData) {
            $orderLines = [];
            foreach ($orderData->ordersLine as $orderLine) {
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
                'id' => $orderData->id,
                'take_away' => $orderData->take_away,
                'table_id' => $orderData->table_id,
                'state' => $orderData->state,
                'created_at' => $orderData->created_at->toIso8601String(),
                'updated_at' => $orderData->updated_at->toIso8601String(),
                'orders_line' => $orderLines,
            ];
        }
        return $ordersJson;
    }

}
