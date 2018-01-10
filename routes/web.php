<?php

//Home Page Controller
Route::get('/', 'HomePageController@index');

//Uploaded file parse controller
Route::post('/result', 'ParseController@parse');

