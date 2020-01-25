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

Route::get('/', 'HomeController@index');
//Route:: get('/result', 'ResultController@index');
Route:: post('/result', 'ResultController@index');
Route:: get('/state', 'stateController@index');


//Route::get('csv_file', 'CsvFile@index');

//Route::get('csv_file/export', 'CsvFile@csv_export')->name('export');