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

Route::get('/', 'AuctionController@showForm');
Route::post('/import', 'AuctionController@import');
Route::get('/perMonth', 'AuctionController@perMonth');
Route::get('/perCategory', 'AuctionController@perCategory');

