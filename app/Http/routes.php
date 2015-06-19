<?php

Route::get('', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');


Route::get('parties', [
    'as' => 'parties_path',
    'uses' => 'PartiesController@index'
]);
Route::get('party/{id}', [
    'as' => 'party_path',
    'uses' => 'PartiesController@show'
]);

Route::get('members', [
    'as' => 'members_path',
    'uses' => 'KnessetMembersController@index'
]);
Route::get('member/{id}.json', [
    'as' => 'member_json_path',
    'uses' => 'KnessetMembersController@showJson'
]);
Route::get('member/{id}', [
    'as' => 'member_path',
    'uses' => 'KnessetMembersController@show'
]);
Route::get('member/{id}/log', 'KnessetMembersController@log');

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

//Route::get('tweeting-test', function()
//{
//    return Twitter::postTweet(array('status' => 'שלום טוויטר! #myfirstTweet #laravel', 'format' => 'json'));
//});

//Route::get('cron-test', function()
//{
//    return 'testing';
//});

//Route::get('test', function () {});