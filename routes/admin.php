<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductController;
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

Route::prefix('admin')->middleware(['auth:sanctum', 'role:super_admin'])->group(function () {

    //categories
    Route::get('categories',[CategoryController::class,'index']);
    Route::post('category',[CategoryController::class,'store']);

    //products
    Route::post('{category}/product',[ProductController::class,'store']);
    Route::get('{category}/products',[ProductController::class,'index']);
    Route::get('product/{product}',[ProductController::class,'show']);





});



