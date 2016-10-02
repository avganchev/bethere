<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

  Route::get('/event', function () {
    return view('layouts.site.event');
  });
  

Route::get('admin', 'Backend\AdminController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('/categories', 'Backend\CategoryController');
    Route::resource('/users', 'Backend\UserController');
    Route::resource('/posts', 'Backend\PostController');
});