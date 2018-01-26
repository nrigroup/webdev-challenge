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

Route::get('/', ['uses' => 'LotController@create'])->name('upload');
Route::post('/lotset/store', ['uses' => 'LotController@store']);
Route::get('/lotset/view/{id}', ['uses' => 'LotSetController@view']);
Route::get('/lotset/view', ['uses' => 'LotSetController@viewAll'])->name('view-all');
Route::get('/lot/view', ['uses' => 'LotSetController@viewAll'])->name('view-all');
