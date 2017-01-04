<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Resolving to url to csv upload form
Route::get('csv/upload', 'CsvController@index');

//Resolving to url to process csv being uploaded
Route::post('csv/upload_csv', 'CsvController@uploadCsv');