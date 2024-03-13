<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Models\Product;


class KitchenController extends Controller
{
    public function index()
    {
        // Obtener todos los pedidos con sus líneas de pedido si su estado es diferente a 'ready' o 'delivered
        $ordersData = Order::with('ordersLine.product')
        ->where('state', '!=', 'ready')
        ->where('state', '!=', 'delivered')
        ->get();
        // Crear un array para almacenar los datos de los pedidos en formato JSON
        $ordersJson = [];

        // Recorrer cada pedido y sus líneas de pedido
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

        return view('kitchen-views.kitchen', [
            'orders' => $ordersJson,
        ]);
    }

    //controlador que verifica si hay pedidos nuevos
    public function sendNewOrders()
    {
                // Obtener todos los pedidos con estado 'new'
        $ordersData = Order::with('ordersLine.product')
        ->where('state', 'new')
        ->get();

        foreach ($ordersData as $order) {
            $order->state = 'preparing';
            $order->save();
        }
        // Crear un array para almacenar los datos de los pedidos en formato JSON
        $ordersJson = [];

        // Recorrer cada pedido y sus líneas de pedido
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
            'state' => $order->state,
            'created_at' => $order->created_at->toIso8601String(),
            'updated_at' => $order->updated_at->toIso8601String(),
        ]);

    }

}
