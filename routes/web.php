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
Route::post('/{table}/ordered', [OrderController::class, 'order'])->name('ordered');
Route::get('/order-list', [OrderController::class, 'list'])->name('order.list');
Route::get('/orders/{order}/details', [OrderController::class, 'detail'])->name('order.detail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/kitchens',App\Http\Controllers\KitchenController::class);
Route::resource('/categories',App\Http\Controllers\CategoryController::class);
Route::resource('/recipes',App\Http\Controllers\RecipeController::class);

Route::resource('/roles',App\Http\Controllers\RoleController::class);
Route::get('/users',[App\Http\Controllers\UserController::class,'index'])->name('users');
Route::get('/users/create',[App\Http\Controllers\UserController::class,'create'])->name('users.create');
Route::post('/users',[App\Http\Controllers\UserController::class,'store'])->name('users.store');
Route::get('/users/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit');
Route::get('/users/{id}/assignPermission',[App\Http\Controllers\UserController::class,'showAssign'])->name('users.assign');
Route::get('/users/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit');
Route::delete('/users/{id}',[App\Http\Controllers\UserController::class,'delete'])->name('users.delete');
Route::put('/permissions/{id}',[App\Http\Controllers\PermissionController::class,'updateAssign'])->name('users.update');
Route::post('/permissions/{id}',[App\Http\Controllers\PermissionController::class,'assignPermission'])->name('users.assignPermissions');



Route::resource('/customers',App\Http\Controllers\CustomerDiscountController::class);
Route::resource('/categoryDiscounts',App\Http\Controllers\CategoryDiscountController::class);
