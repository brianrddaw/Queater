<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class MainUserController extends Controller
{
    public function index()
    {
        return view('user-views.main');
    }
}
