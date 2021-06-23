<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Zx\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('ad', 'AdAdController');
    $router->resource('campaign', 'AdCampaignController');
    $router->resource('product', 'ProductController');
    $router->resource('task', 'TaskController')->names('task.records');
    // $router->get('task/append', 'TaskController@append')->name('task.append');
    // $router->get('task/append', [\App\Admin\Controllers\TaskController::Class, 'append'])->name('task.append');

    $router->get('/user/selectList', [\App\Admin\Controllers\UserController::class, 'selectList'])
        ->name('user.selectList');
});
