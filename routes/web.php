<?php

// Root route
Route::get('/', "MainController@show");
// Post route
Route::post('/handle', "HandleController@show");
// Total route
Route::get('/total', "TotalController@show");

?>