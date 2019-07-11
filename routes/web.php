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

Route::get('/home', 'HomeController@index')->name('home');

// Admin home
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Route Admin Home
    Route::get('admin', 'Admin\AdminController@home')->name('admin-home');

    // Route ke method list users
    Route::get('users', 'Admin\AdminController@list_users');
});

// User Home
Route::group(['middleware' => ['auth', 'role:user']], function () {
    // Route User Home
    Route::get('user', 'User\UserController@home')->name('user-home');
    Route::resource('user', 'User\UserController', ['only' => ['edit', 'update']]);
    // Route User Profile
    Route::get('profile', 'User\UserController@show')->name('user.profile');
});
