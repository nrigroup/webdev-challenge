<?php

//Route::auth();

Route::get('/', 'HomeController@index');

Route::get('upload', 'DataController@upload');
Route::post('upload', 'DataController@upload_processing');