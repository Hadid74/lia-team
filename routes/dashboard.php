<?php


use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('users',[UserController::class,'index']);
Route::put('create-admin/{id}',[UserController::class,'createAdmin']);
Route::get('product',[ProductController::class,'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product', [ProductController::class, 'create']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'delete']);
