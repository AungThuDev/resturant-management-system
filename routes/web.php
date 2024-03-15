<?php

use App\Http\Controllers\DinningPlanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesRecordsController;
use App\Http\Controllers\SettingController;
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
    Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');

    
Route::resource('/tables', TableController::class)->middleware('order-management');
Route::get('/dinning-plans', [DinningPlanController::class, 'index'])->name('plan')->middleware('order-management');
Route::get('/order-here/{table}', [OrderController::class, 'index'])->name('order.here')->middleware('order-management');
Route::post('/{table}/ordered', [OrderController::class, 'order'])->name('ordered');
Route::get('/order-list', [OrderController::class, 'list'])->name('order.list');
Route::get('/orders/{order}/details', [OrderController::class, 'detail'])->name('order.detail');
Route::post('/orders/{order}/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/kitchens',App\Http\Controllers\KitchenController::class)->middleware('menu-management');
Route::resource('/categories',App\Http\Controllers\CategoryController::class)->middleware('menu-management');
Route::resource('/recipes',App\Http\Controllers\RecipeController::class)->middleware('menu-management');

Route::resource('/roles',App\Http\Controllers\RoleController::class)->middleware('user-management');
Route::get('/roles/{id}/assign',[App\Http\Controllers\RoleController::class,'assignForm'])->name('roles.assign');
Route::get('/roles/{id}/editPermission',[App\Http\Controllers\RoleController::class,'editAssign'])->name('roles.editAssign')->middleware('user-management');
Route::put('/roles/{id}/updatePermission',[App\Http\Controllers\PermissionController::class,'updatePermission'])->name('roles.updatePermissions')->middleware('user-management');
Route::post('/roles/{id}',[App\Http\Controllers\PermissionController::class,'assignPermission'])->name('roles.assignPermissions')->middleware('user-management');

Route::get('/users',[App\Http\Controllers\UserController::class,'index'])->name('users')->middleware('user-management');
Route::get('/users/create',[App\Http\Controllers\UserController::class,'create'])->name('users.create')->middleware('user-management');
Route::post('/users',[App\Http\Controllers\UserController::class,'store'])->name('users.store');
Route::get('/users/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit')->middleware('user-management');
Route::get('/users/{id}/assignRole',[App\Http\Controllers\AssignRoleController::class,'assignRole'])->name('users.assign')->middleware('user-management');
Route::post('/users/{id}/assign',[App\Http\Controllers\AssignRoleController::class,'assign'])->name('users.storeRole');
Route::put('/users/{id}',[App\Http\Controllers\UserController::class,'update'])->name('users.update')->middleware('user-management');
Route::delete('/users/{id}',[App\Http\Controllers\UserController::class,'delete'])->name('users.delete')->middleware('user-management');


Route::resource('/customers',App\Http\Controllers\CustomerDiscountController::class)->middleware('discount-management');
Route::resource('/categoryDiscounts',App\Http\Controllers\CategoryDiscountController::class)->middleware('discount-management');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',function(){
        return view('dashboard.index');
    });
    Route::get('/sales-records', [SalesRecordsController::class, 'index'])->name('sales-records.index')->middleware('reporting');
    Route::get('/sales-records/{salerecord}/details', [SalesRecordsController::class, 'details'])->name('sales-records.show')->middleware('reporting');
    Route::get('/receipt/{receipt}', [SalesRecordsController::class, 'print'])->name('print.receipt')->name('reporting');
    Route::get('/settings', [SettingController::class, 'index']);
    Route::post('/settings', [SettingController::class, 'save'])->name('setting.save');
});



Auth::routes();


