<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EatHereController;
use App\Http\Controllers\UserController;

// MAIN ROUTES


// USER ROUTES

Route::get('/', [MainUserController::class, 'index'])->name('user.main');


Route::get('/eat-here', [EatHereController::class, 'index'])->name('eat-here.main');




Route::get('/cash', function () {
    return view('cash-views.cash');
})->name('cash.main');

Route::get('/kitchen', function () {
    return view('kitchen-views.kitchen');
})->name('kitchen.main');






//PRUEBA PARA PODER VER Y GESTIONAR PRODUCTOS.
Route::get('/prueba', [ProductController::class, 'getProducts'])->name('prueba');

//Comprar producto
Route::post('/comprar-producto/{id}', [ProductController::class, 'comprarProducto'])->name('comprar.producto');


Route::post('/make-order', [OrderController::class, 'makeOrder'])->name('make.order');




//////////////////////////
//                      //
//         Login        //
//                      //
//////////////////////////

//Ruta del dashboard, solo se puede acceder si el usuario esta autenticado.
Route::get('/dashboard', function () {
    return view('dashboard-views.dashboard');
})->name('dashboard.main');

//Ruta para el login.
Route::get('/login', function () {
    return view('login-views.login',['route' => 'login']);
})->name('login.main');

//Ruta para el uso del controlador "login".
Route::post('/login', [UserController::class, 'login'])->name('login');

//Ruta para el logout.
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
