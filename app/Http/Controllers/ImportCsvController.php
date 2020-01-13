<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportData;
use Validator;
use DB;

class ImportCsvController extends Controller
{
    public function import() {
        $count = 0;
        $header = true;
        
        if (($handle = fopen ( public_path () . '/upload/data1.csv', 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                if ($header) {
                    $header = false;
                } else {
                $csv_data = new ImportData ();
                $csv_data->date = date('Y-m-d H:i:s', strtotime($data [0]));
                $csv_data->category = $data [1];
                $csv_data->lot_title = $data [2];
                $csv_data->lot_location = $data [3];
                $csv_data->lot_condition = $data [4];
                $csv_data->pre_tax_amount = $data [5];
                $csv_data->tax_name = $data [6];
                $csv_data->tax_amount = $data [7];
                $csv_data->save ();
            }
        }
            fclose ( $handle );
        }
        
        $finalData = $csv_data::all ();
        
        unlink(public_path('upload/data1.csv'));
       
        return redirect()->route( 'data' )->with(['success'=> 'File uploaded.']);
    }

    public function getHome() {
        $currentSpending = DB::table('lotData')->select(DB::raw('SUM(tax_amount + pre_tax_amount) as total, count(*) category'))
        ->get();

        return view('home', ['currentSpending' => $currentSpending]);
    }

    public function importFile() {
        return view('excel');
    }

    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), ['file' => 'required|mimes:csv,txt']);

        if ($validator->passes()) {

            $dataTime = date('Ymd_His');
            $file = $request->file('file');
            $fileName = 'data1.csv';
            $savePath = public_path('/upload');
            $file->move($savePath, $fileName);
            
            return redirect('import');
        } else {
            return redirect()->back()->with(['errors'=> $validator->errors()->all()]);
        }
        
    }

    public function getData()
    {
        $monthlySpending = DB::table('lotData')->select(DB::raw('SUM(tax_amount + pre_tax_amount) as total, count(*) category, year(date) year, month(date) month'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->get();

        $monthlySpendingPerCategory = DB::table('lotData')->select(DB::raw('SUM(tax_amount + pre_tax_amount) as total, category, month(date) month, year(date) year'))
        ->groupBy(['category', 'month', 'year'])->orderBy('year', 'asc')->orderBy('month', 'asc')
        ->get();

        return view('data', ['monthlySpending' => $monthlySpending, 'monthlySpendingPerCategory' => $monthlySpendingPerCategory]);
    }
}
