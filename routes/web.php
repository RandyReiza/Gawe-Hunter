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
    Route::get('admin', 'Admin\AdminController@Index')->name('admin-home');
});

// User Home
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('user', 'User\UserController@Index')->name('user-home');
});
