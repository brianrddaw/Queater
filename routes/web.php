<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
