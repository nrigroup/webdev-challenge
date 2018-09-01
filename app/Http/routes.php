<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Index
Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@home'
]);

// TO store the file
Route::post('/store-file', [
	'as' => 'file.store',
	'uses' => 'HomeController@storeFileData'
]);

// To fetch full CSV data
Route::get('/fetch-full', [
	'as' => 'fetch.category',
	'uses' => 'HomeController@fetchFullData'
]);

// To fetch total based on the month
Route::get('/fetch-per-month', [
	'as' => 'fetch.per.month',
	'uses' => 'HomeController@fetchPerMonth'
]);

// To fetch total based on the category
Route::get('/fetch-per-category', [
	'as' => 'fetch.per.category',
	'uses' => 'HomeController@fetchPerCategory'
]);





