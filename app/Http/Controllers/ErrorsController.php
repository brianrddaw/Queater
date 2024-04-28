<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function index($error, $code, $message)
    {

        return view('error');
    }


    public function showError($error, $code, $message)
    {
        return view('errors.table-not-found', [
            'error' => $error,
            'code' => $code,
            'message' => $message
        ]);
    }
}
