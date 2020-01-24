<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FileserverController extends Controller
{
    public function storeFile (Request $request)
    {
        $file = $request->file('fileinput');
        if ($request->hasFile('fileinput') && $file->isValid()) {

            $filename = uniqid().'_'.$file->getClientOriginalName();
            $path = storage_path('app/public/storage/');
            $request->file('fileinput')->storeAs(
                'public/storage/', $filename
            );

            if($this->readFile($file,$path.$filename))
            {
                return [
                    'msg'       => 'ok',
                    'status'    => '200',
                    'filename'  => $filename
                ];
            }
            else{
                return [
                    'msg'       => 'Error: data format',
                    'status'    => '400'
                ];
            }



        }
        else{
            return [
                'msg'       => 'Error: invalid file',
                'status'    => '400'
            ];
        }

    }

    public function readFile($file, $path){

        $file = fopen($path, "r");

        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );

            // Skip first row
            if($i == 0){
               $i++;
               continue;
            }

            for ($c=0; $c < $num; $c++) {
                if($c == 0)
                {
                     $date = date_create($filedata [$c]);
                     $date = date_format($date,'Y-m-d');
                    $importData_arr[$i][] = $date;
                }
                else
                    $importData_arr[$i][] = $filedata [$c];
            }

            $i++;
        }
        fclose($file);

        //insert into db
        foreach($importData_arr as $importData){

            $insertData = array(
                "date"=>$importData[0],
                "category"=>$importData[1],
                "lot title"=>$importData[2],
                "lot location"=>$importData[3],
                "lot condition"=>$importData[4],
                "pre-tax amount"=>$importData[5],
                "tax name"=>$importData[6],
                "tax amount"=>$importData[7]);
            Data::insertData($insertData);

        }

        return true;
    }
}
