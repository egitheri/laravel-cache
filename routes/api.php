<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

Route::get('/orders', function () {

    $keyCahce = 'order';

    $orders = Cache::remember($keyCahce, 60, function () {
        return DB::table('orders')
            ->select([
                'product_code',
                DB::raw('sum(qty) as total_qty'),
                DB::raw('sum(price) as total_price')
            ])
            ->groupBy('product_code')
            ->get();
    });

    return $orders;
});
