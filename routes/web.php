<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/tree', function () {
    return view('tree');
});
//测试路由
Route::get('/test', 'TestController@test');

//路由组，方便添加中间件，进行用户认证及授权
Route::group(['middleware' => ['auth','authorize'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('home', function(){
        return view('admin/home');
    });

    //菜单
    Route::any('menu/index', 'MenuController@index');
    Route::any('menu/create/{pid?}', 'MenuController@create');
    Route::any('menu/delete/{id}', 'MenuController@delete');
    Route::any('menu/update/{id}', 'MenuController@update');

    //角色
    Route::any('role/index', 'RoleController@index');
    Route::any('role/create', 'RoleController@create');
    Route::any('role/delete/{id}', 'RoleController@delete');
    Route::any('role/update/{id}', 'RoleController@update');
    Route::any('role/permission/{id}', 'RoleController@permission');
    Route::post('role/updatePermission/{id}', 'RoleController@updatePermission');
    Route::any('role/user/{id}', 'RoleController@user');
    Route::any('role/deleteUser/{id}/{userId}', 'RoleController@deleteUser');
});

