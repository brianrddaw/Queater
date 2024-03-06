<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EatHereController extends Controller
{
    public function index(){
        return view ('user-views.eat-here');
    }
}
