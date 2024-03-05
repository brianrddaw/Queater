<?php

use Illuminate\Support\Facades\Route;


// MAIN ROUTES

Route::get('/', function () {
    return view('user-views.user');
})->name('user.main');

Route::get('/cash', function () {
    return view('cash-views.cash');
})->name('cash.main');

Route::get('/kitchen', function () {
    return view('kitchen-views.kitchen');
})->name('kitchen.main');
