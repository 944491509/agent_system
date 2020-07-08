<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'domain' => config('admin.route.domain'),
//    'prefix'        => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('area-stands', District\AreaStandController::class);

    //  区站基础管理
    $router->group(['prefix' => 'district'], function (Router $router) {
        $router->resource('users', District\UserController::class);
        $router->resource('area-stands', District\AreaStandController::class);
        $router->resource('facilitators', District\FacilitatorsController::class);
        $router->resource('departments', District\DepartmentController::class);
        $router->resource('posts', District\PostController::class);
        $router->resource('task-groups', District\TaskGroupController::class);
        $router->resource('majors', District\MajorController::class);
        $router->resource('automobiles', District\AutomobileController::class);
    });

    // 基础资料
    $router->group(['prefix' => 'initialValue'], function (Router $router) {
        $router->resource('professional-skills', InitialValue\ProfessionalSkillController::class);

    });

});
