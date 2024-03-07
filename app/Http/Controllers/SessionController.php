<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    //Funcion para devolver todos los productos en un objeto JSON
    public function createSession()
    {
        $session = new Session();
        $session->status = 1;
        $session->save();

        //Se guarda la session_id en las cookies del navegador.
        setcookie('session_id', $session->id, time() + (86400 * 30), "/");
    }

    public function closeSession()
    {
        //Se obtiene el id de la session almacenado en las cookies del navegador.
        $session_id = $_COOKIE['session_id'];

        //Se busca la session en la base de datos.
        $session = Session::find($session_id);

        //Se cambia el estado de la session a 0.
        $session->status = 0;
        $session->save();

        //Se elimina la session_id de las cookies del navegador.
        setcookie('session_id', '', time() - 3600, "/");
    }

    public function getSession()
    {
        //Se obtiene el id de la session almacenado en las cookies del navegador.
        $session_id = $_COOKIE['session_id'];

        //Se busca la session en la base de datos.
        $session = Session::find($session_id);

        return $session;
    }

}
