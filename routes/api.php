<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('city', 'API\CheckoutController@getCity');
Route::get('district', 'API\CheckoutController@getDistrict');
Route::get('subdistrict', 'API\CheckoutController@getSubDistrict');
Route::post('cost', 'API\CheckoutController@getCourier');

// Route::get('district', 'Ecommerce\CartController@getDistrict');
// Route::get('subdistrict', 'Ecommerce\CartController@getSubDistrict');
// Route::post('cost', 'Ecommerce\CartController@getCourier');
