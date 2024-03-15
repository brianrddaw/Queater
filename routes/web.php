<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EatHereController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TakeAwayController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\DashboardController;
// MAIN ROUTES


// USER ROUTES
Route::get('/', [MainUserController::class, 'index'])->name('user.main');

//Ruta para obtener los productos.
Route::get('/eat-here', [EatHereController::class, 'eatHere'])->name('eat-here.main');

//Ruta para obtener los productos.
Route::get('/take-away', [TakeAwayController::class , 'takeAway'])->name('take-away.main');

//Llama a un controlador enviando la id del producto.
Route::get('/product/{product}', [ProductController::class, 'index'])->name('product');

//Ruta para obtener los productos.
Route::get('/cash', function () {
    return view('cash-views.cash');
})->name('cash.main');


//////////////////////////
//                      //
//        Kitchen       //
//                      //
//////////////////////////
Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.main');
//Enviar los pedidos con el estado new.
Route::get('/kitchen/orders/new', [KitchenController::class, 'sendNewOrders'])->name('kitchen.orders.new');
//Cambiar el estado del pedido.
Route::post('/kitchen/orders/change-status', [KitchenController::class, 'changeOrderStatus'])->name('kitchen.orders.change-status');
//Hacer el pedido
Route::post('/make-order', [OrderController::class, 'makeOrder'])->name('make.order');




//////////////////////////
//                      //
//         Login        //
//                      //
//////////////////////////


//Ruta para el login.
Route::get('/login', function () {
    return view('login-views.login',['route' => 'login']);
})->name('login.main');

//Ruta para el uso del controlador "login".
Route::post('/login', [UserController::class, 'login'])->name('login');

//Ruta para el logout.
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


//////////////////////////
//                      //
//         Session      //
//                      //
//////////////////////////

//Ruta para crear una nueva session.
Route::get('/create-session', [MainUserController::class, 'createSession'])->name('create.session');

//Ruta para cerrar la session.
Route::get('/close-session', [MainUserController::class, 'closeSession'])->name('close.session');

//Ruta para obtener el id de la session.
Route::get('/get-session-id', [MainUserController::class, 'getSessionId'])->name('get.session.id');


//////////////////////////
//                      //
//       Dashboard      //
//                      //
//////////////////////////

//Ruta del dashboard, solo se puede acceder si el usuario esta autenticado.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.main');

//Ruta para obtener los productos en dashboard.
Route::get('/dashboard/products', [DashboardController::class, 'showProducts'])->name('dashboard.products');

//Ruta para obtener las categorias en dashboard.
Route::get('/dashboard/categories', [DashboardController::class, 'showCategories'])->name('dashboard.categories');

//Ruta para obtener las mesas en dashboard.
Route::get('/dashboard/tables', [DashboardController::class, 'showTables'])->name('dashboard.tables');
