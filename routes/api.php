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

Route::prefix('v1')->group(function(){
    Route::get('unauthorized', ['as' => 'api.unauthorized', 'uses' => 'Api\AuthController@unauthorized']);

    Route::post('login', ['as' => 'api.login', 'uses' => 'Api\AuthController@login']);
    Route::post('register', ['as' => 'api.register', 'uses' => 'Api\AuthController@register']);
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('getProfile', ['as' => 'api.profile', 'uses' => 'Api\AuthController@getProfile']);
    });
});