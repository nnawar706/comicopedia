<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VolumeController;
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

Route::middleware('auth.api')->group(function () {
    Route::get('search/autocomplete', [EcommerceController::class, 'searchOptions']);
    Route::get('genres', [CategoryController::class, 'index']);
    Route::get('catalogues', [CatalogueController::class, 'catalogueData']);

    Route::controller(VolumeController::class)->group(function () {
        Route::get('series/volumes/{id}', 'volumeList');
        Route::get('volumes/most-sold', 'volumeSellReport');
        Route::get('volumes/order-report/{volume_id}', 'volumeOrderReport');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('users/ratio-over-time', 'userRatio');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('order-statuses', 'getOrderStatuses');
        Route::get('order-summary', 'getOrderSummary');
    });

});
