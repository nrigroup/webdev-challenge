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

Route::get('/', [
  'uses' => 'ItemsController@index',
  'as' => 'index'
]);

Route::post('upload', [
  'uses' => 'ItemsController@processCSV',
  'as' => 'data.process'
]);

Route::get('items', [
  'uses' => 'ItemsController@getTotals',
  'as' => 'items'
]);
