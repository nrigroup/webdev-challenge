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

Route::get('/', 'InventoryManagerController@index');

// Route::post('/import', 'InventoryManagerController@import_inventory');

Route::post('/import', 'InventoryManagerController@import_inventory')->name('import');
Route::get('/search_result', 'InventoryManagerController@search_result')->name('search');
