<?php

Route::get('', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');


Route::get('parties', [
    'as' => 'parties_path',
    'uses' => 'PartiesController@index'
]);
Route::get('party/{party}', [
    'as' => 'party_path',
    'uses' => 'PartiesController@show'
]);

Route::get('member/{member}.json', [
    'as' => 'member_json_path',
    'uses' => 'KnessetMembersController@showJson'
]);
Route::get('member/{member}', [
    'as' => 'member_path',
    'uses' => 'KnessetMembersController@show'
]);
Route::get('member/{member}/log', 'KnessetMembersController@log');

Route::get('tweets', 'TweetsController@index');
Route::get('tweet/{id}', [
    'as' => 'tweet_path',
    'uses' => 'TweetsController@show'
]);

Route::get('fullscreen', [
    'as' => 'fullscreen_path',
    'uses' => 'KnessetMembersController@fullscreen'
]);
Route::get('inside', [
    'as' => 'inside_path',
    'uses' => 'KnessetMembersController@inside'
]);
Route::get('outside', [
    'as' => 'outside_path',
    'uses' => 'KnessetMembersController@outside'
]);

Route::get('leaderboard', 'KnessetMembersController@allTimeTable');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('profile', 'UsersController@show');
Route::get('profile/edit', 'UsersController@edit');
Route::post('profile/edit', 'UsersController@update');
Route::get('profile/{user}', 'UsersController@show');

Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function()
{
    Route::get('/', function(){
        return redirect()->route('dashboard');
    });
    Route::get('dashboard', [
        'name' => 'dashboard',
        'uses' => 'AdminController@index'
    ]);
    Route::resource('users', 'UsersController');
    Route::resource('knessetmembers', 'KnessetMembersController');
    Route::resource('parties', 'PartiesController');
});