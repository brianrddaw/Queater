<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Cashier\Facades\Stripe; // Importa la fachada de Stripe

class UserController extends Controller
{
    public function login()
    {
        $credentials = request()->only('email', 'password');
        $route = request()->route;
        if(Auth::attempt($credentials)){
            request()->session()->regenerate();
        }

        return redirect(route($route));
    }

    public function logout()
    {
        $route = request()->route;

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route($route));
    }

    public function procesarPago(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $user->defaultPaymentMethod();

        // Cargar el método de pago
        $user->charge(1000, $paymentMethod->id);

        // Si se utiliza suscripciones, crear una suscripción
        // $user->newSubscription('plan_id', 'plan_name')->create($paymentMethod->id);

        return redirect()->back()->with('success', 'Pago procesado exitosamente.');
    }
}
