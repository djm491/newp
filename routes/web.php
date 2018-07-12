<?php
Route::get('/','ServerController@index');





/*
 * API Calls
 */

Route::get('/get-servers','ServerController@getServers');
