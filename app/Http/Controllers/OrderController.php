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
        $preparingOrderData = Order::where('state', 'preparing')
                                ->with('ordersLine.product')
                                ->orderby('created_at', 'asc')
                                ->get();

        $preparingOrderJson = $this->formatOrdersData($preparingOrderData);

        return $preparingOrderJson;
    }

    public function getReadyOrders()
    {
        $readyOrdersData = Order::where('state', 'ready')
                            ->where('created_at', '>=', now()->subHours(72))
                            ->with('ordersLine.product')
                            ->orderby('created_at', 'asc')
                            ->get();
        $readyOrdersJson = $this->formatOrdersData($readyOrdersData);
        return $readyOrdersJson;
    }

    public function getTakeAwayOrders($preparing = false, $ready = false)
    {
        $takeAwayOrdersData = Order::where('take_away', true)
                                ->with('ordersLine.product')
                                ->orderby('created_at', 'asc');

        if ($preparing) {
            $takeAwayOrdersData = $takeAwayOrdersData->where('state', 'preparing');
        }
        if ($ready) {
            $takeAwayOrdersData = $takeAwayOrdersData->where('state', 'ready');
        }

        $takeAwayOrdersData = $takeAwayOrdersData->get();

        $takeAwayOrdersJson = $this->formatOrdersData($takeAwayOrdersData);
        return $takeAwayOrdersJson;
    }

    public function getTakeAwayOrdersReadys()
    {
        $takeAwayOrdersData = Order::where('take_away', true)
                                ->where('state', 'ready')
                                ->with('ordersLine.product')
                                ->orderby('created_at', 'asc')
                                ->get();

        $takeAwayOrdersJson = $this->formatOrdersData($takeAwayOrdersData);
        return $takeAwayOrdersJson;
    }

    public function getEatHereOrders($preparing = false, $ready = false)
    {
        $eatHereOrdersData = Order::where('take_away', false)
                                ->with('ordersLine.product')
                                ->orderby('created_at', 'asc');

        if ($preparing) {
            $eatHereOrdersData = $eatHereOrdersData->where('state', 'preparing');
        }
        if ($ready) {
            $eatHereOrdersData = $eatHereOrdersData->where('state', 'ready');
        }

        $eatHereOrdersData = $eatHereOrdersData->get();

        $eatHereOrdersJson = $this->formatOrdersData($eatHereOrdersData);
        return $eatHereOrdersJson;
    }

    public function getEatHereOrdersReadys()
    {
        $eatHereOrdersData = Order::where('take_away', false)
                                ->where('state', 'ready')
                                ->with('ordersLine.product')
                                ->orderby('created_at', 'asc')
                                ->get();

        $eatHereOrdersJson = $this->formatOrdersData($eatHereOrdersData);
        return $eatHereOrdersJson;
    }

    public function formatOrdersData($ordersData)
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
                //Formatea la fecha a un formato dia/mes/año hora:minutos
                'created_at' => $orderData->created_at->format('H:i'),
                'updated_at' => $orderData->updated_at->format('H:i'),
                'orders_line' => $orderLines,
            ];
        }
        return $ordersJson;
    }

    public function changeOrderState(Request $request)
    {
        $valid_states = ['new', 'preparing', 'ready', 'delivered'];

        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if (!in_array($order->state, $valid_states)) {
            return response()->json(['error' => 'Invalid state'], 422);
        }else{
            if ($order->state === 'new') {
                $order->state = 'preparing';
                $order->save();
                return response()->json(['message' => 'Order state changed to preparing']);
            } else if ($order->state === 'preparing') {
                $order->state = 'ready';
                $order->save();
                return response()->json(['message' => 'Order state changed to ready']);
            } else if ($order->state === 'ready') {
                $order->state = 'delivered';
                $order->save();
                return response()->json(['message' => 'Order state changed to delivered']);
            } else {
                return response()->json(['error' => 'Invalid state','state' => $order->state], 422);
            }
        }

    }
}
