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
    Route::get('get-areas', 'Api\ChinaAreaController@getAreas')
        ->name('api.area.get-areas');
});


// 项目部模块
Route::group(['prefix'=> 'stand'],function () {
    // 获取项目部的上级
    Route::get('get-parent-stand', 'Api\District\AreaStandController@getParentStand')
        ->name('api.stand.get-parent-stand');
    // 获取项目部下的部门
    Route::get('get-departments', 'Api\District\DepartmentController@getDepartmentByStandId')
        ->name('api.stand.get-departments');
    // 所有项目部
    Route::get('get-all-area-stand', 'Api\District\AreaStandController@getAllAreaStand');
    // 班组
    Route::get('get-group', 'Api\District\AreaStandController@getGroup');
    // 岗位
    Route::get('get-post', 'Api\District\AreaStandController@getPost');
    // 专业
    Route::get('get-major', 'Api\District\AreaStandController@getMajor');
    // 专业的等级
    Route::get('get-major-classes', 'Api\District\AreaStandController@getProfessionalClasses');

});
