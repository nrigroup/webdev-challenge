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
    return view('welcome');
});

Route::get('/upload', 'Controller@upload_file');


Route::get('/categories', 'CategorieController@index');
Route::post('/categories', 'CategorieController@store');
Route::get('/categories/create', 'CategorieController@create');
Route::get('/categories/{categorie}', 'CategorieController@show');
Route::get('/categories/{categorie}/edit', 'CategorieController@edit');
Route::put('/categories/{categorie}', 'CategorieController@update');
Route::delete('/categories/{categorie}', 'CategorieController@destroy');

Route::get('/conditions', 'ConditionController@index');
Route::post('/conditions', 'ConditionController@store');
Route::get('/conditions/create', 'ConditionController@create');
Route::get('/conditions/{condition}', 'ConditionController@show');
Route::get('/conditions/{condition}/edit', 'ConditionController@edit');
Route::put('/conditions/{condition}', 'ConditionController@update');
Route::delete('/conditions/{condition}', 'ConditionController@destroy');

