<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use App\Lot;
use App\Categorie;
use App\Condition;
use App\Taxe;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
	    return view('upload');  
    }

    public function report(){
    	$total_lots = DB::table('lots')->count();
    	$total_categories = DB::table('categories')->count();
    	$total_conditions = DB::table('conditions')->count();
    	$total_taxes = DB::table('taxes')->count();

    	$categories = \DB::table('categories')
                ->orderBy('name', 'asc')
                ->get();

        foreach ($categories as $_category) {
            $category = Categorie::find($_category->id);
            $category->total_amount = $category->calculate_total_amount($category->id);
            $category->save();
        }
        $lots = \DB::table('lots')->get();
        
        foreach($lots as $_lot){
        	$lot = Lot::find($_lot->id);
        	$lot->total_amount_per_month = $this->getMonthlySum($lot->date_lot);
        	$lot->save();
        }

	    return view('report', [
	    	'total_lots' => $total_lots,
	    	'total_categories' => $total_categories,
	    	'total_conditions' => $total_conditions,
	    	'total_taxes' => $total_taxes,
	    	'categories' => $categories,
	    	'lots' => $lots,
	    ]);  
    }


    public function store()
    {
    	$file = request()->filename;
    	$filename = $file->getClientOriginalName();
 		$file->storeAs('csv',$filename);
    	$data = $this->readCSV('storage/csv/' . $filename);

    	foreach ($data as $line) 
    	{
    		$lot = new Lot();
	    	$lot->title = $line['lot title'];
	    	$lot->location = $line['lot location'];

			$condition = new Condition();
	    	$lot->condition = $condition->findOrCreate($line['lot condition']);

	    	$category = new Categorie();
	    	$lot->categorie = $category->findOrCreate($line['category']);

	    	$lot->pre_taxe_amount = $line['pre-tax amount'];

	    	$taxes_region = new Taxe();
	    	$lot->taxes_region = $taxes_region->findOrCreate($line['tax name']);

	    	$lot->taxe_amount = $line['tax amount'];

	    	$lot->date_lot = Carbon::createFromFormat('m/d/Y', $line['date']); ;
	    	$lot->save();
    	}
    }

    public function readCSV(String $filename){
    	if (!file_exists($filename) || !is_readable($filename))
        return false;

    	$header = null;
    	$data = array();
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, ",")) !== false)
	        {
	            if (!$header)
	                $header = $row;
	            else
	                $data[] = array_combine($header, $row);
	        }
	        fclose($handle);
	    }
    return $data;
    }

    public function getMonthlySum(Carbon $date)
	{

	    $year = $date->year;
	    $month = $date->month;

	    if ($month < 10) {
	        $month = '0' . $month;
	    }

	    $search = $year . '-' . $month;

	    $lots = Lot::where('date_lot', 'like', $search .'%')->get();	    

	    $sum = 0;

	    foreach ($lots as $lot) {
	        $sum += $lot->pre_taxe_amount + $lot->taxe_amount;
	    }

	    return $sum;
	}
}



