<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProductsController;
use App\Http\Controllers\Back\UnderProductController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category',CategoryController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('underproduct', UnderProductController::class);
});

Route::get('contact',[ContactController::class, 'index']);
require __DIR__.'/auth.php';
