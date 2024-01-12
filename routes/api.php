<?php

use App\Http\Api\Invoice\Controller\InvoiceController;
use App\Http\Api\Product\Controller\ProductController;
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

// Product
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
});

// Invoice
Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'list']);
    Route::post('/', [InvoiceController::class, 'create']);
});
