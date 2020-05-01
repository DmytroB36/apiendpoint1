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

Route::middleware('auth:api')->group(function () {

    // TODO move routes here

});
