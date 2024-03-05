<?php

use App\Http\Controllers\DinningPlanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
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

Route::get('/', function () {
    return view('layouts.master');
});

Route::resource('/tables', TableController::class);
Route::get('/dinning-plans', [DinningPlanController::class, 'index'])->name('plan');
Route::get('/order-here/{table}', [OrderController::class, 'index'])->name('order.here');
Route::get('/ordered', [OrderController::class, 'order'])->name('ordered');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
