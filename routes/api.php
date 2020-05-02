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

Route::get('/balance', 'ApiController@getBalance');
Route::get('/items', 'ApiController@getItems');
Route::post('/items/add', 'ApiController@addItem');
Route::post('/items/remove', 'ApiController@removeItem');

Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {

        Route::get('auth', 'AuthController');
        Route::post('logout', 'LogoutController');
    });
});
