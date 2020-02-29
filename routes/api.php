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

Route::apiResources([
    'menu' =>'API\ProductController'
]);
Route::apiResources([
    'category' =>'API\CategoryController'
]);
Route::apiResources([
    'invoice' =>'API\InvoiceDetailController'
]);
Route::apiResources([
    'order' =>'API\OrdersController'
]);


Route::get('profile', 'API\ProfileController@userProfile');
Route::put('profile', 'API\ProfileController@updateProfile');
Route::get('items','API\ProductController@getItems');
Route::get('searchcategory','API\CategoryController@filterCategories');
Route::get('searchmenu','API\ProductController@filterproducts');
//Route::post('updateorder/{id}','API\OrdersController@filterproducts');

Route::get('report/menu','API\ReportController@menu');
Route::get('report/sales','API\ReportController@sales');
Route::get('dashboard', 'API\DashboardController@index');


