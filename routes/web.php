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
use App\Http\Controllers\CashController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\LandPageController;
use App\Http\Controllers\TableController;

//////////////////////////
//                      //
//      LandPage        //
//                      //
//////////////////////////
Route::get('/', [LandPageController::class, 'index']);





//////////////////////////
//                      //
//        User          //
//                      //
//////////////////////////

// USER ROUTES
//Route::get('/', [MainUserController::class, 'index'])->name('user.main');
//Ruta para obtener los productos.
Route::get('/eat-here/{table}', [EatHereController::class, 'eatHere'])->name('eat-here.main');
//Ruta para obtener los productos.
Route::get('/take-away', [TakeAwayController::class , 'takeAway'])->name('take-away.main');

// PAYMENT ROUTE

Route::get('/payment', [StripeController::class, 'index'])->name('payment.index');
Route::post('/checkout', [StripeController::class, 'checkout'])->name('payment.checkout');
Route::get('/success', [StripeController::class, 'success'])->name('payment.success');
Route::get('/getTicket/{id}/{tableId}', [StripeController::class, 'getTicket'])->name('payment.getTicket');
Route::get('/printTicket/{id}/{tableId}', [StripeController::class, 'printTicket'])->name('payment.printTicket');


//Ruta para obtener los productos.
Route::get('/cash',[CashController::class, 'index'])->name('cash.main');

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

//Ruta para crear un nuevo producto.
Route::post('/dashboard/products/create', [DashboardController::class, 'createNewProduct'])->name('dashboard.products.create');

//Actualizar producto con nuevos valores
Route::post('/dashboard/products/update', [DashboardController::class, 'updateProduct'])->name('dashboard.products.update');

//Eliminar producto
Route::delete('/dashboard/products/delete/{id}', [DashboardController::class, 'deleteProduct'])->name('dashboard.products.delete');

//Crear nueva categoria
Route::post('/dashboard/categories/create', [DashboardController::class, 'createNewCategory'])->name('dashboard.categories.create');

//Actualizar categoria
Route::post('/dashboard/categories/update', [DashboardController::class, 'updateCategory'])->name('dashboard.categories.update');

//Eliminar categoria
Route::delete('/dashboard/categories/delete/{id}', [DashboardController::class, 'deleteCategory'])->name('dashboard.categories.delete');



//////////////////////////
//                      //
//        Tables        //
//                      //
//////////////////////////



//Ruta para obtener las mesas en dashboard.
Route::get('/dashboard/tables', [TableController::class, 'showTables'])->name('dashboard.tables');

//Ruta para crear una nueva mesa.
Route::get('/dashboard/tables/create', [TableController::class, 'createTable'])->name('dashboard.tables.create');




//////////////////////////
//                      //
//       Products       //
//                      //
//////////////////////////

//Llama a un controlador enviando la id del producto.
Route::get('/product/{product}', [ProductController::class, 'index'])->name('product');


//////////////////////////
//                      //
//          QR          //
//                      //
//////////////////////////

//Ruta para generar un código QR.
Route::get('/generate-qr-code/{string}', [QrCodeController::class, 'generateQrCode'])->name('generate.qr.code');

//TODO: Modificar ruta para descargar qrs en especifico.
//Ruta para descargar un código QR.
Route::get('/download-qr-code/{number}', [QrCodeController::class, 'downloadQrCode'])->name('download.qr.code');

