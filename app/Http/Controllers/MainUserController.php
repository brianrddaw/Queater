<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class MainUserController extends Controller
{
    public function index()
    {
        $session = new Session();
        $session->save();

        //Se guarda la session_id en las cookies del navegador.
        setcookie('session_id', $session->id, time() + (86400 * 30), "/");

        return view('user-views.main');
    }

}
