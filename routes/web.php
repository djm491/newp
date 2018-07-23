<?php

Route::group(['middleware' => 'auth'], function (){

Route::get('/home','ServerController@index')->name('home');
Route::get('/','ServerController@index');

/*
 * API Calls
 */

Route::get('/get-servers','ServerController@getServers');
});
Route::get('/login','UserController@getLoginForm');
Route::post('/login','UserController@Login');
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});

