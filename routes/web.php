<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
// MAIN ROUTES


Route::get('/', [UserController::class, 'index'])->name('user.main');

Route::get('/cash', function () {
    return view('cash-views.cash');
})->name('cash.main');

Route::get('/kitchen', function () {
    return view('kitchen-views.kitchen');
})->name('kitchen.main');

Route::get('/dashboard', function () {
    return view('dashboard-views.dashboard');
})->name('dashboard.main');


Route::get('/prueba', [ProductController::class, 'getProducts'])->name('prueba');

//Comprar producto
Route::post('/comprar-producto/{id}', [ProductController::class, 'comprarProducto'])->name('comprar.producto');
