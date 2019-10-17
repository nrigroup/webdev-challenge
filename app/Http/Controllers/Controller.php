<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Lot;
use App\Categorie;
use App\Condition;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(){
	    return view('upload');  
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
}



