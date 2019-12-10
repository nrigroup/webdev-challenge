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

Route::get('/', array('uses' => 'HomeController@index'))->name('homePage');
Route::post('/', array('uses' => 'AuctionsController@store'))->name('auctionSubmit');

Route::get('/dashboard/{month?}/{year?}', array('uses' => 'DashboardController@index'))->name('dashboardPage');
Route::post('/dashboard/submit', array('uses' => 'DashboardController@submit'))->name('dashboardSubmit');