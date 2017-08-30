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

Route::get('/', 'UploadController@show');
Route::get('/inventory', 'InventoryController@show');
Route::get('/category-report', 'InventoryController@categoryReport');
Route::get('/monthly-report', 'InventoryController@monthlyReport');

Route::post('/inventory', 'InventoryController@store');
Route::post('/upload', 'UploadController@store');
