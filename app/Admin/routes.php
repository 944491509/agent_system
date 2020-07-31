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
        $router->any('outputExcel', 'District\AutomobileController@outputExcel');

        $router->resource('instruments', District\InstrumentController::class);
    });

    // 基础资料
    $router->group(['prefix' => 'initialValue'], function (Router $router) {
        $router->resource('professional-skills', InitialValue\ProfessionalSkillController::class);
    });


    // 网络隐患
    $router->group(['prefix' => 'trouble'], function (Router $router) {
        $router->resource('trouble-form', Trouble\TroubleFormController::class);
    });

    // 网络故障
    $router->group(['prefix' => 'fault'], function (Router $router) {
        // 故障来源
        $router->resource('source', Fault\SourceController::class);
        // 故障性质
        $router->resource('nature', Fault\NatureController::class);
        // 故障列表
        $router->resource('list', Fault\NetworkFaultController::class);
    });

});
