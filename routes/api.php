<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

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

Route::group(['prefix'=> 'area'],function () {
    Route::get('get-areas', 'Api\ChinaAreaController@getAreas')->name('api.area.get-areas');
}) ;

Route::group(['prefix'=>'user'], function(){
    Route::any('index', 'Api\UserController@index');
});
