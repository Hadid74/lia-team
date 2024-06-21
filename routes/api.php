<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('user/register', [AuthController::class, 'register']);
Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::post('user/logout',[AuthController::class,'logout']);
    Route::post('order',[OrderController::class,'create']);
});
Route::get('products',[ProductController::class,'index']);
