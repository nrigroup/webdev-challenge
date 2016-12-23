<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function homeSweetHome()
	{
		return view('welcome');
	}
	public function auctionFile()
	{
		return view('pages.auction');
	}
	public function saveFile(Request $request)
	{
		
		/*Data needs to be saved here*/
		if ($request->hasFile('fileName')) {
			$fileNameData = $request->file('fileName');
			$fileName = $request->file('fileName')->getClientOriginalName();
			
			$file = fopen($fileNameData, "r");
			$header = true;
			$stack = array();
			$stackMonth = array();
			
			$category = array();

			while ($csvLine = fgetcsv($file, 0, ",")) {
				if ($header) {
					$header = false;
				} 
				else 
				{
					$current = floatval($csvLine[5] + $csvLine[7]);
					//month logic
					$date = strtotime($csvLine[0]);
					$dateMonthNumber = date('n',$date);
					$dateMonthString = date('F',$date);
					
					if (array_key_exists($dateMonthNumber,$stack))
					{
						$stack[$dateMonthNumber] = $current + $stack[$dateMonthNumber];
						
					}
					else
					{
						$stack[$dateMonthNumber] = $current;
						$stackMonth[$dateMonthNumber] = $dateMonthString;
					}
					
					//category logic
					$cate = $csvLine[1];
					if (array_key_exists($cate,$category))
					{
						$category[$cate] = $current + $category[$cate];
					}
					else
					{
						$category[$cate] = $current;

					}

				}
			}
			ksort($stack);
			return view('pages.save', ['fnd' => $stackMonth, 'fn' => $stack, 'cate' => $category]);
		}
	}
}
