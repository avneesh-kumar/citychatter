<?php

// use App\Http\Controllers\ProfileController;
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
Route::get('/reset-password/{token}', 'App\Http\Controllers\ResetPasswordController@index')->name('reset-password');
Route::post('/reset-password/store', 'App\Http\Controllers\ResetPasswordController@store')->name('reset-password.store');
Route::post('/currentlocation', 'App\Http\Controllers\HomeController@currentlocation')->name('currentlocation');
Route::get('/privacy-policy', 'App\Http\Controllers\PrivacyPolicyController@index')->name('privacy-policy');
Route::get('/terms', 'App\Http\Controllers\TermsController@index')->name('terms');
Route::get('/mission', 'App\Http\Controllers\MissionController@index')->name('mission');
Route::get('/about', 'App\Http\Controllers\AboutController@index')->name('about');
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::post('/contact', 'App\Http\Controllers\ContactController@store')->middleware('recaptcha')->name('contact.store');
Route::get('/help', 'App\Http\Controllers\HelpController@index')->name('help'); 

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth',
], function () {

    Route::group([
        'namespace' => 'Account',
        'prefix' => 'account',
    ], function () {
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile/store', 'ProfileController@store')->name('profile.store');
        Route::get('/profile/username', 'ProfileController@username')->name('username');
        Route::get('/reset-password', 'ResetPassword@index')->name('account.reset-password');
        Route::post('/reset-password/store', 'ResetPassword@store')->name('account.reset-password.store');

        
    });
    
    Route::get('/category/search', 'CategoryController@search')->name('category.search');

    Route::get('/feed/{type?}', 'App\Http\Controllers\FeedController@index')->name('feed');
    
    Route::get('/post/create/{id?}', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/post/{slug}', 'App\Http\Controllers\PostController@index')->name('post');
    Route::post('/post', 'App\Http\Controllers\PostController@store')->name('post.store');
    Route::post('/post/delete', 'App\Http\Controllers\PostController@delete')->name('post.delete');
    Route::post('/post/like', 'App\Http\Controllers\PostController@like')->name('post.like');
    Route::post('/post/unlike', 'App\Http\Controllers\PostController@unlike')->name('post.unlike');
    Route::post('/post/comment', 'App\Http\Controllers\PostController@comment')->name('post.comment');
    Route::post('/post/comment/reply', 'App\Http\Controllers\PostController@commentReply')->name('post.comment.reply');
    Route::post('/post/report', 'App\Http\Controllers\PostReportController@report')->name('post.report');

    Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user');
    Route::get('/user/profile/{username}', 'App\Http\Controllers\UserController@profile')->name('user.profile');
    Route::post('/user/follow', 'App\Http\Controllers\UserController@follow')->name('user.follow');
    Route::post('/user/unfollow', 'App\Http\Controllers\UserController@unfollow')->name('user.unfollow');
    
    Route::get('/message', 'App\Http\Controllers\MessageController@index')->name('message');
    Route::get('/message/view', 'App\Http\Controllers\MessageController@view')->name('message.view');
    Route::post('/message/send', 'App\Http\Controllers\MessageController@send')->name('message.send');
    Route::post('/message/reply', 'App\Http\Controllers\MessageController@reply')->name('message.reply');
    Route::post('/message/delete', 'App\Http\Controllers\MessageController@delete')->name('message.delete');

    Route::post('/logout', 'Account\LogoutController@index')->name('logout');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Account',
    'middleware' => 'guest',
], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@authenticate')->middleware('recaptcha')->name('login.authenticate');
    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@store')->middleware('recaptcha')->name('register.store');
    Route::get('/lost-password', 'LostPasswordController@index')->name('lost-password');
    Route::post('/lost-password/email', 'LostPasswordController@email')->middleware('recaptcha')->name('lost-password.email');
    Route::get('/validate-email/{token}', 'RegisterController@validateEmail')->name('register.validateemail');
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
