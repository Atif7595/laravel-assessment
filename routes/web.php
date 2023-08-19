<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Front\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


 //  Front Products Route
Route::get('/',[MainController::class,'index'])->name('front');

 //  Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 //  Authentication Routes

Auth::routes();

 // Admin Panel Routes

Route::group(['middleware'=>['auth','isAdmin']],function(){
// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Display the dashboard

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('product.Index'); // Display list of products
Route::get('create/product', [ProductController::class, 'create'])->name('product.Create'); // Show product creation form
Route::post('store/product', [ProductController::class, 'store'])->name('store.Product'); // Store a new product
Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.Edit'); // Show edit form for a specific product
Route::post('product/update/{product}', [ProductController::class, 'update'])->name('product.Update'); // Update a specific product
Route::get('product/delete/{product}', [ProductController::class, 'delete'])->name('product.Delete'); // Show delete confirmation for a specific product

// Client Routes
Route::get('/clients', [ClientController::class, 'index'])->name('client.Index'); // Display list of clients
Route::get('client/edit/{client}', [ClientController::class, 'edit'])->name('client.Edit'); // Show edit form for a specific client
Route::post('client/assingprice', [ClientController::class, 'assingPrice'])->name('assingMultiprice'); // Assign multiple prices to a specific client

});

//logout Route
Route::get('logout',function(){
    Auth::logout();
    return redirect(route('front'));
})->name('get.Logout');




