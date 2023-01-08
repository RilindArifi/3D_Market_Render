<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\CategorySubController;
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



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/showproducts/{category}', 'show_products')->name('show_products');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::resource('category',CategoryController::class);
    Route::resource('category_sub',CategorySubController::class);
    Route::resource('product', ProductController::class);
});

require __DIR__.'/auth.php';
