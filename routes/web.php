<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/', function () {
    return view('otentikasi.login');
});
Route::get('/register', function () {
    return view('otentikasi.register');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'main'])->name('main');
Route::get('/products', [ProductController::class, 'products'])->name('products');


Route::middleware(['admin'])->group(function () {
    Route::get('/create_product', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/store_product', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/edit_product/{product}', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::patch('/edit_product/{product}', [ProductController::class, 'update_product'])->name('update_product');
    Route::delete('/products/{product}', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm_payment'])->name('confirm_payment');
    Route::get('/user_management', [UserController::class, 'users'])->name('user_management');
    Route::post('/user_management/{id}/create_admin', [UserController::class, 'create_admin'])->name('create_admin');
    Route::post('/user_management/{id}/create_user', [UserController::class, 'create_user'])->name('create_user');
    Route::get('/add_user', [UserController::class, 'add_user'])->name('add_user');
    Route::post('/store_user', [UserController::class, 'store_user'])->name('store_user');
    Route::delete('/user_management/{user}', [UserController::class, 'delete_user'])->name('delete_user');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/show_total_cart', [ProductController::class, 'show_total_cart'])->name('show_total_cart');
    Route::get('/show_product/{product}', [ProductController::class, 'show_product'])->name('show_product');
    Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
    Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order', [OrderController::class, 'index_order'])->name('order');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
    Route::get('/show_profile', [ProfileController::class, 'show_profile'])->name('show_profile');
    Route::post('/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');
    Route::delete('/order/{id}', [OrderController::class, 'delete_order'])->name('delete_order');
});
