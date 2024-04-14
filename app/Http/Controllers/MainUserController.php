<?php

namespace App\Http\Controllers;

class MainUserController extends Controller
{
    public function index()
    {
        return view('user-views.main');
    }
}
