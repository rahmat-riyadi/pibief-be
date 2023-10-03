<?php

use App\Http\Controllers\API\{
    PurchaseController,
    PurchaseProductController,
    VendorController
};
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'purchase'], function(){

    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('/waiting', 'getWaitingPurchase');
        Route::get('/paid', 'getPaidPurchase');
        Route::get('/missing', 'getMissingPurchase');
        Route::get('/bill', 'getPurchaseBill');
        Route::post('/', 'store');
        Route::delete('/{purchase}', 'delete');
    });

    Route::group(['prefix' => 'product'],function(){
        Route::controller(PurchaseProductController::class)->group(function(){
            Route::get('/', 'index');
        });
    });

});

Route::group(['prefix' => 'entity'], function(){
    Route::group(['prefix' => 'vendor'], function(){
        Route::controller(VendorController::class)->group(function(){
            Route::get('/','index');
            Route::get('/show/{vendor}','show');
            Route::post('/','store');
            Route::patch('/update/{vendor}','update');
            Route::delete('/delete/{vendor}','destroy');
        });
    });
});

