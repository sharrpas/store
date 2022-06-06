<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//authentication
Route::post('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum')->name('logout');
Route::post('/change/pass',[UserController::class, 'changePass'])->middleware('auth:sanctum')->name('changePass');

//menu
Route::get('categories',[CategoryController::class, 'index'])->name('categories');

//products
Route::get('{category}/products',[ProductController::class,'index']);
Route::get('product/{product}',[ProductController::class,'show']);

//cart
Route::post('cart/{product}',[CartController::class,'store'])->middleware('auth:sanctum');
