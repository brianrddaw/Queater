<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EatHereController;

// MAIN ROUTES


// USER ROUTES

Route::get('/', [UserController::class, 'index'])->name('user.main');
Route::get('/eat-here', [EatHereController::class, 'index'])->name('eat-here.main');




Route::get('/cash', function () {
    return view('cash-views.cash');
})->name('cash.main');

Route::get('/kitchen', function () {
    return view('kitchen-views.kitchen');
})->name('kitchen.main');

Route::get('/dashboard', function () {
    return view('dashboard-views.dashboard');
})->name('dashboard.main');



//PRUEBA PARA PODER VER Y GESTIONAR PRODUCTOS.
Route::get('/prueba', [ProductController::class, 'getProducts'])->name('prueba');

//Comprar producto
Route::post('/comprar-producto/{id}', [ProductController::class, 'comprarProducto'])->name('comprar.producto');


Route::post('/make-order', [OrderController::class, 'makeOrder'])->name('make.order');
