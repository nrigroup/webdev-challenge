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
	$links = \App\Link::all();
    return view('welcome', ['links' => $links]);
});

//*********************************************//
Route::get('/upload-auction-file', function () {
    return view('addAuctionAwards');
});

Route::get('/view-spendings', function () {
    return view('viewTotalSpendings');
});


//*********************************************//


//*********************************************//
Route::get('/add-new-link', function () {
    return view('addNewLink');
});

use Illuminate\Http\Request;

Route::post('/submitAndAddNewLink', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Link($data))->save();

    return redirect('/');
});
//*********************************************//

Route::get('/addAuctionFile', 'AuctionAwardsController@addAuctionAwards'); 
Route::post('/uploadFile', 'AuctionAwardsController@uploadFile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
