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

Route::get('/', 'ItemController@index');

Route::get('/items', 'ItemController@index');

Route::get('/items/create', 'ItemController@create');

Route::get('/items/summary', 'ItemController@summary');

Route::get('/items/{item}', 'ItemController@show');

Route::post('/items','ItemController@store');

