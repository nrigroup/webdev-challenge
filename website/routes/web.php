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
    return redirect('user');
	
});
Auth::routes();

Route::get('file/import/{id}', 'FileController@import');
Route::get('file/download/{id}', 'FileController@download');
Route::get('user/login', 'UserController@login');
Route::get('user/register', 'UserController@register');
Route::resource('user', 'UserController');
Route::resource('tax', 'TaxController');
Route::resource('file', 'FileController');
Route::resource('lot', 'LotController');
Route::resource('category', 'LotCategoryController');
