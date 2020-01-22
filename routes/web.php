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

Route::get('/', 'LotsController@index')->name('lots.home');
Route::get('/lots', 'LotsController@index')->name('lots.index');
Route::get('/lots/about',  'LotsController@about')->name('lots.about');
Route::get('/lots/create', 'LotsController@create');
Route::get('/lots/report', 'LotsController@report');
Route::get('/lots/upload', 'LotsController@upload');
Route::get('/lots/edit/{lot}', 'LotsController@edit');
Route::get('/lots/delete/{lot}', 'LotsController@delete');
Route::get('/lots/{lot}', 'LotsController@show')->name('lots.show');

Route::post('/lots/create', 'LotsController@store');
Route::post('/lots/loadcsv', 'LotsController@loadcsv');

Route::put('/lots/update/{lot}', 'LotsController@update');
