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

/*
Route::get('/', function () {
    return view('welcome');
});*/


//Route::get('/', 'pageController@getData');
//Route::post('/insert', 'pageController@insert');

Route::get('/', 'pageController@welcome_to_NRI');
Route::post('/', 'pageController@welcome_to_NRI');
Route::post('/upload', 'pageController@upload');
Route::get('/upload', 'pageController@getupload');

Route::get('upload', function () {
    return redirect('/');
});

//Route::get('/', 'pageController@hello');

//Route::get('/', 'pageController@readCSV_File');
//Route::get('/', 'dbController@getData');