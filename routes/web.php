<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ActionController;
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
// Главная страница
Route::redirect('/', '/products');

// Продукты
Route::resource('products', ProductController::class);

// Поставки и заказы
Route::get('/stocks', [StockController::class, 'index'])->name('stocks');

// Поставки
Route::post('/save-supply', [StockController::class, 'add_supply'])->name('save-supply');
Route::get('/show-supply/{supply}', [StockController::class, 'show_supply'])->name('show-supply');
Route::put('/update-supply/{id}', [StockController::class, 'update_supply'])->name('update-supply');
Route::delete('/delete-supply/{id}', [StockController::class, 'destroy_supply'])->name('destroy-supply');

// Заказы
Route::post('/save-order', [StockController::class, 'add_order'])->name('save-order');
Route::get('/show-order/{order}', [StockController::class, 'show_order'])->name('show-order');
Route::put('/update-order/{id}', [StockController::class, 'update_order'])->name('update-order');
Route::delete('/delete-order/{id}', [StockController::class, 'destroy_order'])->name('destroy-order');

// Брать продукты выбранной категории
Route::post('/category-products', [ActionController::class, 'category_products'])->name('category-products');

// Брать все остальные продукты от всех партий
Route::post('/rest-supplies', [ActionController::class, 'rest_supplies'])->name('rest-supplies');

Route::post('/rest-products', [ActionController::class, 'rest_products'])->name('rest-product-amount');