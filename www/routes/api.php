<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('api.products.list');
        Route::get('/products/search/{keyword}', 'search')->name('api.products.search');
        Route::post('/products', 'store')->name('api.products.store');
        Route::put('/products/{id}', 'update')->name('api.products.update');
    });
});
