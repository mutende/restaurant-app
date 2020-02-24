<?php

use Illuminate\Http\Request;

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
Route::apiResources([
    'hotel' =>'API\HotelController'
]);
<<<<<<< HEAD
Route::apiResources([
    'menu' =>'API\ProductController'
]);
Route::apiResources([
    'category' =>'API\CategoryController'
]);
Route::apiResources([
    'invoice' =>'API\InvoiceDetailController'
]);
=======

Route::get('profile', 'API\ProfileController@userProfile');
Route::put('profile', 'API\ProfileController@updateProfile');

>>>>>>> bcd28e1e1f5e4a897eb520d5f3dd3d356be05870
