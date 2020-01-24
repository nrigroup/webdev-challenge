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

Route::get('auction', 'AuctionController@index')->name('auction_index');
Route::post('import_csv', 'AuctionController@importCSV')->name('auction_import_csv');
Route::get('total_spending', 'AuctionController@totalSpending')->name('auction_total_spending');
