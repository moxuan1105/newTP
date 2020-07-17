<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('/','index/index');
Route::get('login/','login/index');

Route::group('index',function(){
    Route::get('/','index');
    Route::get('index','index');
    Route::rule('welcome','welcome');
    Route::miss('miss');
})->prefix('index/');

Route::group('login',function(){
    Route::get('/','index');
    Route::get('index','index');
    Route::get('register','register');
    Route::post('login','login');
    Route::post('store','store');
    Route::rule('logout','logout');
    Route::miss('miss');
})->prefix('login/');

Route::group('user',function(){
    Route::get('userList','userList');
    Route::get('getUserInfo','getUserInfo');
    Route::get('modifyPassword','modifyPasswordView');
    Route::post('modifyPassword','modifyPassword');
    Route::miss('miss');
})->prefix('user/');

Route::group('staffs',function(){
    Route::get('index','index');
    Route::get('getList','getList');
    Route::get('search','search');
    Route::post('upload','upload');
})->prefix('staffs/');