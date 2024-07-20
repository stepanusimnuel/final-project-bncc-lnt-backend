<?php

use Illuminate\Support\Facades\Route;
use App\Models\Toy;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\IsAdmin;

Route::get('/', [ToyController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/toys/{toy:id}', [ToyController::class, 'show'])->middleware('auth');

Route::post('/checkout/toys/{toy}', [CheckoutController::class, 'storeOne'])->middleware('auth');
Route::get('/cart/remove/{toy}', [CheckoutController::class, 'removeFromCart'])->middleware('auth');
Route::post('/cart/checkout', [CheckoutController::class, 'checkout'])->middleware('auth');
Route::get('/cart/toys', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('/cart/toys/{toy}', [CheckoutController::class, 'addToCart'])->middleware('auth');

Route::resource('admin/toys', AdminController::class)->except('show')->middleware([IsAdmin::class]);
