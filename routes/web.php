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


Route::get('/',  'ImportCsvController@getHome')->name('home');

Route::get('import',  'ImportCsvController@import')->name('import');

Route::get('importFile',  'ImportCsvController@importFile');

Route::post('importFile',  'ImportCsvController@importExcel');

Route::get('data', 'ImportCsvController@getData')->name('data');