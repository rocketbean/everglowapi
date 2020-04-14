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

Route::post("test", "UserController@register");
Route::post("testUserLogin", "UserController@testUserLogin");
Route::post("login", "UserController@authenticate");

// Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'shop'], function () {
        Route::post('/', 'ShopController@create');
        Route::get('/', 'ShopController@list');
        Route::group(['prefix' => '{shop}'], function () {
            Route::get('/', 'ShopController@index');
            Route::post('/item', 'ItemController@create');

        });
    });
});
