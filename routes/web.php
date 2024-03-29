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
    return redirect()->route('job.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route Role Admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Route Admin Home
    Route::get('admin', 'Admin\AdminController@home')->name('admin-home');

    // Route ke method list users
    Route::get('list-users', 'Admin\AdminController@list_users')->name('list-users');
    // Route ke method list users
    Route::post('destroy-users', 'Admin\AdminController@destroyUsers')->name('destroy-users');
    // Route accept
    Route::post('accept', 'Admin\AdminController@accept')->name('accept');
    // Route reject
    Route::post('reject', 'Admin\AdminController@reject')->name('reject');
    // Route Download CV
    Route::post('download-cv', 'Admin\AdminController@downloadCV')->name('download-cv');
});

// Route Role User
Route::group(['middleware' => ['auth', 'role:user']], function () {
    // Route User Home
    Route::get('user', 'User\UserController@home')->name('user-home');
    // Route Resource user
    Route::resource('user', 'User\UserController', ['only' => ['edit', 'update']]);
    // Route StoreCV
    Route::post('storeCV', 'User\UserController@storeCV')->name('store-CV');
    // Route User Profile
    Route::get('profile', 'User\UserController@show')->name('user.profile');
    // Route skill, bikin route resource tp hanya store yg d gunakan
    Route::resource('skill', 'User\SkillController', ['only' => ['store', 'destroy']]);
    // Route experience, bikin route resource tp hanya store yg d gunakan
    Route::resource('experience', 'User\ExperienceController', ['only' => ['store', 'destroy']]);
    // Route apply job
    Route::post('apply', 'User\UserController@apply')->name('apply');
    // Route Download CV
    Route::post('downloadCV', 'User\UserController@downloadCV')->name('downloadCV');
});


// Route job, bikin route resource
Route::resource('job', 'JobController');
