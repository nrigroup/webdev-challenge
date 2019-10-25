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

Route::get('/', function () {
    return view('import');
});

Route::get('productsexport', 'MyController@productsexport')->name('productsexport');
Route::get('importExportView', 'MyController@importExportView');
Route::post('import', 'MyController@import')->name('import');
Route::get('calculate', 'MyController@calculate')->name('calculate');
Route::post('import', 'MyController@ProductsImport')->name('ProductsImport');
