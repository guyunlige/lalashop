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

// 模型绑定到路由中，绑定到具体的方法

// Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');


//列表
Route::get('/posts','\App\Http\Controllers\PostController@index');
//详情
Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');

//创建文章
Route::get('/posts/create','\App\Http\Controllers\PostController@create');
Route::post('/posts','\App\Http\Controllers\PostController@store');

// 编辑文章
Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');

// 删除文章
Route::get('/posts/delete','\App\Http\Controllers\PostController@delete');














