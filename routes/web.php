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

Route::get('/', 'ItemsController@index')->name('index');
Route::get('/show_table', 'ItemsController@showTable')->name('show_table');
Route::post('upload_file', 'ItemsController@uploadFile')->name('upload_file');
