<? php

Route::get('/', function () {
   return view('home');
});


Route::get('/hello',['uses' => 'HomeController@index'])

?>
