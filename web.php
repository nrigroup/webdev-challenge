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
 * 
 * Basic Routes with 'Auth' routes and checking authentication so that users can access the pages.
 * 
 * 
 */


Route::get('/', function () {

    if(Auth::check())
    return view('home');
    else
        return view('auth/login');
});




route::get('/check',function(){

    /*
     * Getting the name of CSV file uploaded.
     * Using maatwebsite/excel to work with excel files.
     *       Importing Excel file using maatwebsite/excel and storing excel data in $result.
     * 
     * Inserting $result in database.
     */

    $fname=$_GET['file'];

    $address = 'data\files/'.$fname;
    Excel::load($address, function($reader) {
    $results = $reader->get();

        $data=array();

       foreach($results as $result)
       {
           $data[]=array(

               'date'=>$result->date,
               'category'=>$result->category,
               'lotTitle'=> $result->lot_title,
               'lotLocation'=>$result->lot_location,
               'lotCondition'=> $result->lot_condition,
               'preTax'=> $result->pre_tax_amount,
               'taxName'=>$result->tax_name,
               'taxAmount'=>$result->tax_amount,
               'userId'=>\Illuminate\Support\Facades\Auth::user()->id,
           );
       }

        \Illuminate\Support\Facades\DB::table('data')->insert($data);

    });

    return redirect('/')->withFlashMessage('Data Imported!');
});



route::get('/listData',function(){

    if(Auth::check()){
        return view('listData');
    }
    else
    {
        return view('auth/login');
    }

});

Route::post('perform', 'NRI@UploadFile');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('register',function(){
   return view('auth/login');

});