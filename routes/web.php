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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('import-view', 'ExcelController@importView')->name('import.view');

Route::post('/import-file', 'ExcelController@importFile');
Route::get('/import', 'ExcelController@importView');
Route::get('/table', 'ExcelController@tableView');
Route::post('/destroy-file', 'ExcelController@destroyTable');
Route::post('/destroy-single', 'ExcelController@destroy');