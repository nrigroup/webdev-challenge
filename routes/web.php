<?php

Route::get('/','HomeController@index')->name('home');
Route::post('/parse-and-save','CsvController@parseAndSave')->name('csv.parse-and-save');
