<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Models\Session;

class OrderController extends Controller
{

    public function showCart()
    {
        return view('views.user-views.user-cart.user-cart');
    }


    public function makeOrder(Request $request)
    {
        //Crear pedido
        $order = new Order();
        $order->take_away = $request->takeAway;
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

        //Elimnar la session
        $session = Session::find($_COOKIE['session_id']);
        $session->delete();


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

    public function getTotal(Request $request)
    {
        $total = OrdersLine::where('order_id', $request->order_id)->sum('price * quantity');
        return $total;
    }

}
