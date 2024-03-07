<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login()
    {
        $credentials = request()->only('email', 'password');

        if(Auth::attempt($credentials)){
            request()->session()->regenerate();
            return redirect(route('dashboard.main'));
        }

        return redirect(route('dashboard.main'));
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route('dashboard.main'));
    }
}
