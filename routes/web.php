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
    return view('/items/upload');
});

Route::get('/items/view', 'ItemsController@view');
Route::get('/items/upload', 'ItemsController@upload');
Route::get('/items/uploads/', 'ItemsController@uploads');
Route::get('/items/upload_detailed/{id}', 'ItemsController@upload_detailed');
Route::post('/items/process', 'ItemsController@process');