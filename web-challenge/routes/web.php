<?php
use Illuminate\Http\Request;
use App\Purchase;
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
    return view('web-challenge');
});

/**
 * Rout to process CSV upload and return calculated results
 */
Route::post('/csv-upload', function( Request $request){
    $response_array = array();
    $by_cat_tot = array();
    $by_month_tot = array();
    $file = fopen($request->uploadfile->path(), 'r');

    // Loop throw rows and insert after converting formats
    $header = fgetcsv($file, "1000", ",");
    while (($data = fgetcsv($file, "1000", ",")) !== false){
        //Combine array with keys for convenience
        $insert_array = array_combine($header, $data);
        foreach ($insert_array as $k => $v){
            if($k == "date"){
                $d = DateTime::createFromFormat("m/d/Y" , $v);
                $insert_array[$k] = $d->format("Y-m-d") ;
            }
        }
        // date,category,lot title,lot location,lot condition,pre-tax amount,tax name,tax amount
        $purchase  = Purchase::create([
            'date' => $insert_array['date'],
            'category' => $insert_array['category'],
            'lot_title' => $insert_array['lot title'],
            'lot_location' => $insert_array['lot location'],
            'lot_condition' => $insert_array['lot condition'],
            'pre_tax_amount' => $insert_array['pre-tax amount'],
            'tax_name'=> $insert_array['tax name'],
            'tax_amount' =>$insert_array['tax amount']
        ]);
    }
            //Now Aggregate data
            $by_cat_month = Purchase::getCategoryPerMonth();
            $month_tot = Purchase::getByMonthTotal();
            $cat_tot = Purchase::getByCategoryTotal();

            //Prep json response
            for ($i=0; $i < count($cat_tot) ; $i++) { 
                $by_cat_tot[$cat_tot[$i]['category']] = $cat_tot[$i]['SUM(pre_tax_amount)'];
            }

            foreach ($month_tot as $key => $value) {
                $by_month_tot[$key] = $value['SUM(pre_tax_amount)'];

            }
            
            //Send json response to client
            return array('success'=> true, 'result'=> array('cat' => $by_cat_tot, 'moncat' => $by_cat_month, 'month' => $by_month_tot));
});