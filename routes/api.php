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

Route::post('emails','SendEmailController@send');
Route::get('emails','SendEmailController@list');
Route::get('emails/{id}','SendEmailController@get');

Route::get('themes', 'ThemeApiController@list');
Route::get('themes/{id}', 'ThemeApiController@get');
Route::post('themes', 'ThemeApiController@save');
Route::put('themes/{id}', 'ThemeApiController@save');