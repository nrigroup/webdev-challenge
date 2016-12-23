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

Route::get('/', 'PagesController@homeSweetHome');

Route::get('auction', 'PagesController@auctionFile');

Route::post('auction/save', 'PagesController@saveFile');

Route::get('auction/save', 'PagesController@auctionFile');




