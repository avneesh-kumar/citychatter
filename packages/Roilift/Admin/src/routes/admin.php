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
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::post('/category/delete', 'CategoryController@destroy')->name('category.delete');

    Route::get('/post', 'PostController@index')->name('post');
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::post('/post/store', 'PostController@store')->name('post.store');
    Route::post('/post/delete', 'PostController@destroy')->name('post.delete');

    
    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/register', 'UserController@register')->name('user.register');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/get', 'UserController@getUser')->name('user.get');
    


    Route::get('/account', 'AccountController@index')->name('account');
    Route::get('/logout', 'LogoutController@index')->name('logout');
});

?>