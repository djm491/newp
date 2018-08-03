<?php

Route::get('/login','UserController@getLoginForm');
Route::get('/','UserController@getLoginForm');
Route::post('/login','UserController@Login');
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});
Route::group(['middleware' => 'auth'], function (){
Route::get('/home','ServerController@index')->name('home');
Route::get('/edit/mass-streams','StreamController@showMassEditPage');
Auth::routes();
/*
 * API Calls
 */

Route::get('/get-servers','ServerController@getServers');
Route::get('/get-streams','StreamController@getStreams');
});


