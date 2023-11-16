<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin', 
    'namespace' => 'Roilift\Admin\Http\Controllers',
    'middleware' => ['web', 'guest'],
    'as' => 'admin.'
],function () {
    Route::get('/', 'LoginController@index')->name('login');
    Route::post('/', 'LoginController@login')->name('login.post');
});

Route::group([
    'prefix' => 'admin', 
    'namespace' => 'Roilift\Admin\Http\Controllers',
    'middleware' => ['web', 'auth:admin'],
    'as' => 'admin.'
],function () {
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::get('/category/edit', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::post('/category/delete', 'CategoryController@delete')->name('category.delete');

    Route::get('/post', 'PostController@index')->name('post');
    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/account', 'AccountController@index')->name('account');
    Route::get('/logout', 'LogoutController@index')->name('logout');
});

?>