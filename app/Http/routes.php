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

Route::get('inside', [
    'as' => 'inside_path',
    'uses' => 'KnessetMembersController@inside'
]);
Route::get('outside', [
    'as' => 'outside_path',
    'uses' => 'KnessetMembersController@outside'
]);

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('home', function(){
    return 'yay ^-^';
});