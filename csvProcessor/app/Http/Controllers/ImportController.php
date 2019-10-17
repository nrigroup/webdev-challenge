<?php

namespace App\Http\Controllers;

use App\ItemDetails;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    //
    public function index()
    {
        return view('ImportCSV.importCsv');
    }

    public function import()
    {
        request()->validate([
           'csvFile' => 'required'
        ]);
        $file=request()->file('csvFile');
        $csvFile=file($file->getRealPath());
        $data = [];
        $lineNum = 0;
        $monthTotal = [];
        for($i = 1; $i <= 12; $i++){
            $monthTotal[$i] = 0;
        }
        $categoryTotal = [];
        foreach ($csvFile as $line) {
            if($lineNum > 0){
                $data = str_getcsv($line);
                ItemDetails::create([
                    'date' => $data[0],
                    'category' => $data[1],
                    'lot title'=> $data[2],
                    'lot location'=> $data[3],
                    'lot condition'=> $data[4],
                    'pre-tax amount'=> $data[5],
                    'tax name'=> $data[6],
                    'tax amount'=> $data[7],
                ]);

                $month = (int) date("m",strtotime($data[0]));
                if( array_key_exists($month, $monthTotal)){
                    $monthTotal[$month] += (int) $data[7];
                }else{
                    $monthTotal[$month] = (int) $data[7];
                }

                $category = $data[1];
                if( array_key_exists($category, $categoryTotal)){
                    $categoryTotal[$category] += (int) $data[7];
                }else{
                    $categoryTotal[$category] = (int) $data[7];
                }
            }
            $lineNum++;
        }
        return view(
            'importCSV/importCsv',
            [
                'monthTotal' => $monthTotal,
                'categoryTotal' => $categoryTotal,
            ]);

    }
}
