<?php

namespace App\Http\Controllers;

class MainUserController extends Controller
{
    public function index($mesa)
    {
        if ($mesa == 1) {
            return view('user-views.main');
        }
    }
}
