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

Route::get('/', ['uses' => 'LotSetController@create'])->name('upload');

Route::get('lotset/show/{id}', ['uses' => 'LotSetController@show'])->name('showLotSet');
Route::post('lotset/store', ['uses' => 'LotSetController@store']);
Route::get('lotset/show', ['uses' => 'LotSetController@index'])->name('viewAll');
