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
    return view('auth.login');
});


Route::middleware('auth')->group(function(){
    Route::get('/dashboard',function(){
        return view('dashboard.index');
    });
    
    Route::resource('/tables', TableController::class);
    Route::get('/dinning-plans', [DinningPlanController::class, 'index'])->name('plan');
    Route::get('/order-here/{table}', [OrderController::class, 'index'])->name('order.here');
    Route::post('/{table}/ordered', [OrderController::class, 'order'])->name('ordered');
    Route::get('/order-list', [OrderController::class, 'list'])->name('order.list');
    Route::get('/orders/{order}/details', [OrderController::class, 'detail'])->name('order.detail');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/kitchens',App\Http\Controllers\KitchenController::class)->middleware('menu-management');
Route::resource('/categories',App\Http\Controllers\CategoryController::class)->middleware('menu-management');
Route::resource('/recipes',App\Http\Controllers\RecipeController::class)->middleware('menu-management');

Route::resource('/roles',App\Http\Controllers\RoleController::class);
Route::get('/users',[App\Http\Controllers\UserController::class,'index'])->name('users')->middleware('user-management');
Route::get('/users/create',[App\Http\Controllers\UserController::class,'create'])->name('users.create')->middleware('user-management');
Route::post('/users',[App\Http\Controllers\UserController::class,'store'])->name('users.store');
Route::get('/users/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit')->middleware('user-management');
Route::get('/users/{id}/assignPermission',[App\Http\Controllers\UserController::class,'showAssign'])->name('users.assign')->middleware('user-management');

Route::delete('/users/{id}',[App\Http\Controllers\UserController::class,'delete'])->name('users.delete');
Route::put('/permissions/{id}',[App\Http\Controllers\PermissionController::class,'updateAssign'])->name('users.update');
Route::post('/permissions/{id}',[App\Http\Controllers\PermissionController::class,'assignPermission'])->name('users.assignPermissions');

Route::resource('/customers',App\Http\Controllers\CustomerDiscountController::class);
Route::resource('/categoryDiscounts',App\Http\Controllers\CategoryDiscountController::class);
});



Auth::routes();


