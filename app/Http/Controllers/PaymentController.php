<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PaymentController extends Controller
{

    public function index (){
        return view('user-views.user-payments.payments');
    }

    public function proccessPayment(Request $request){

        $response = Http::post('https:://connect.squareupsandbox.com/v2/payments', [

            'amount_money' => [
                'amount' => $request->amount,
                'currency' => 'EUR',
            ],
            'source_id' => $request->googlePayToken,

        ])->withHeaders ([
            'Authorization' => 'Bearer ' . config('app.square_access_token'),
            'Content-Type' => 'application/json',
        ]);

        return response()->json($response->json());
    }
}
