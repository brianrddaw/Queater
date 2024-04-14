<?php

namespace App\Http\Controllers;

use App\Models\Session;

class SessionController extends Controller
{
    public function createSession()
    {
        $session = new Session();
        $session->status = 1;
        $session->save();

        setcookie('session_id', $session->id, time() + (86400 * 30), "/");
    }

    public function closeSession()
    {
        $session_id = $_COOKIE['session_id'];
        $session = Session::find($session_id);
        $session->status = 0;
        $session->save();

        setcookie('session_id', '', time() - 3600, "/");
    }

    public function getSession()
    {
        $session_id = $_COOKIE['session_id'];
        $session = Session::find($session_id);
        return $session;
    }

}
