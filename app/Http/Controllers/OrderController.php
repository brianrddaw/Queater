<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersLine;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        
        //Crear pedido
        $order = new Order();
        $order->save();

        //Crear lineas de pedido
        foreach($request->products as $product)
        {
            $orderLine = new OrdersLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $product['id'];
            $orderLine->quantity = $product['quantity'];
            $orderLine->save();
        }
        echo "Pedido creado: " . json_encode($request->products);
    }
}
