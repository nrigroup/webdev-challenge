<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('itemCRUD', ['as' => 'itemCRUD.index','uses' => 'ItemCRUDController@index']);
Route::get('itemCRUD/create', ['as' => 'itemCRUD.create','uses' => 'ItemCRUDController@create']);
Route::post('itemCRUD/store', ['as' => 'itemCRUD.store','uses' => 'ItemCRUDController@store']);
Route::get('itemCRUD/{id}/edit', ['as' => 'itemCRUD.show','uses' => 'ItemCRUDController@show']);
Route::get('itemCRUD/show/{id}', ['as' => 'itemCRUD.edit','uses' => 'ItemCRUDController@edit']);
Route::patch('itemCRUD/update/{id}', ['as' => 'itemCRUD.update','uses' => 'ItemCRUDController@update']);
Route::get('itemCRUD/destroy/{id}', ['as' => 'itemCRUD.destroy','uses' => 'ItemCRUDController@destroy']);

Route::get('/getImport','ExcelController@getImport');
Route::post('/postImport','ExcelController@postImport');
Route::get('/getExport','ExcelController@getExport');
//Route::resource('itemCRUD','ItemCRUDController');
