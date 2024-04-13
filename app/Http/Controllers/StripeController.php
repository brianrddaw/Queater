<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersLine;
use App\Http\Controllers\OrderController;
use Barryvdh\DomPDF\Facade\Pdf;


class StripeController extends Controller
{
    protected $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }


    public function index()
    {
        return view('user-views.user-payments.payment');
    }

    public function checkout(Request $request)
    {
        $total = floatval($request->input('orderTotal')) * 100;
        $order = $request->input('order');
        $takeAway = $request->input('takeAway');
        $queryParams = http_build_query([
            'takeAway' => $takeAway,
            'order' => json_encode($order),
        ]);

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Pedido de prueba',
                        ],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?' . $queryParams,
            'cancel_url' => route ('payment.index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        $takeAway = $request->input('takeAway');
        $orderData = json_decode($request->input('order'), true);

        $orderId = $this->_makeOrder($takeAway, $orderData);
        return redirect()->route('payment.getTicket', ['id' => $orderId])->with('success', '¡Ticket obtenido correctamente!');
    }

    public function getTicket($orderId)
    {
        return view('user-views.user-payments.success', compact('orderId'));
    }

    public function printTicket(PDF $pdfCreator, $orderId)
    {
        $orderController = new OrderController();
        $resultado = $orderController->getOrderByCondition(['orderId' => $orderId]);

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif'])->loadView("user-views.user-payments.ticket", compact('resultado'));
        return $pdf->download("ticket" . $orderId . ".pdf");
    }

    private function _makeOrder($takeAway, $orderData)
    {
        $orderData = json_decode($orderData, true);
        $order = new Order();
        $order->take_away = $takeAway;
        $order->save();

        foreach ($orderData['order'] as $productId => $product) {
            $orderLine = new OrdersLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $product['id'];
            $orderLine->quantity = $product['quantity'];
            $orderLine->save();
        }
        return $order->id;
    }

}
