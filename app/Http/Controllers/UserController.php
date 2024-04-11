<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

}
