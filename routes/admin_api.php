<?php

use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('users', UserController::class)->only('index', 'show');
Route::post('users/{id}/role-admin', [UserController::class,'changeRoleAdmin']);
Route::get('orders', [OrderController::class,'index']);
Route::post('orders/concat', [OrderController::class,'concat']);
Route::post('orders/{id}/cancel', [OrderController::class,'cancel']);
Route::apiResource('cities', CityController::class);
