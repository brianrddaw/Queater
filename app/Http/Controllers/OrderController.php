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
            $orderLine->price = $product['price'];
            $orderLine->save();
        }
        echo "Pedido creado: " . json_encode($request->products);
    }

    public function putProductToOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $orderLine = new OrdersLine();
        $orderLine->order_id = $order->id;
        $orderLine->product_id = $request->product_id;
        $orderLine->quantity = $request->quantity;
        $orderLine->save();
        echo "Producto añadido al pedido";
    }

    public function deleteProductFromOrder(Request $request)
    {
        $orderLine = OrdersLine::where('order_id', $request->order_id)->where('product_id', $request->product_id)->first();
        $orderLine->delete();
        echo "Producto eliminado del pedido";
    }

    public function getOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $orderLines = OrdersLine::where('order_id', $request->order_id)->get();
        return view('order', ['order' => $order, 'orderLines' => $orderLines]);
    }
}
