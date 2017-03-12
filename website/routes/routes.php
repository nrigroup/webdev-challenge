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

Route::get('/', function () {
    return view('welcome');
	
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('user/login', 'UserController@login');
Route::get('user/register', 'UserController@register');
Route::resource('user', 'UserController');
Route::resource('file', 'FileController');
Route::resource('lot', 'LotController');
Route::resource('lotCat', 'LotCatController');
