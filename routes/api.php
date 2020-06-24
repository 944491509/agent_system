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

// 获取地区的下级
Route::group(['prefix'=> 'area'],function () {
    Route::get('get-areas', 'Api\ChinaAreaController@getAreas')->name('api.area.get-areas');
});


// 获取项目部的上级
Route::group(['prefix'=> 'stand'],function () {
    Route::get('get-areas', 'Api\District\AreaStandController@getParentStand')->name('api.stand.get-parent-stand');
});
