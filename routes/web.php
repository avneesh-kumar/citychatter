<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/plain', 'App\Http\Controllers\HomeController@plain')->name('plain');
Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth',
], function () {
    Route::get('/feed/{type?}', 'App\Http\Controllers\FeedController@index')->name('feed');
    
    Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/post/{slug}', 'App\Http\Controllers\PostController@index')->name('post');
    Route::post('/post', 'App\Http\Controllers\PostController@store')->name('post.store');
    Route::post('/post/like', 'App\Http\Controllers\PostController@like')->name('post.like');
    Route::post('/post/unlike', 'App\Http\Controllers\PostController@unlike')->name('post.unlike');
    Route::post('/post/comment', 'App\Http\Controllers\PostController@comment')->name('post.comment');

    Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user');
    Route::get('/user/profile', 'App\Http\Controllers\UserController@profile')->name('user.profile');
    
    Route::post('/logout', 'Account\LogoutController@index')->name('logout');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Account',
    'middleware' => 'guest',
], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@authenticate')->name('login.authenticate');
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@store')->name('register.store');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
