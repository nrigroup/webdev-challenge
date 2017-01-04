<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use App\Http\Middleware\CheckAge;

class CsvController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        session()->forget('msg');
        session()->forget('err');

        return view('csv/upload')->with('data', array())
                ->with('results', '');
    }

    //Upload Csv file here
    public function uploadCsv() {
        $processedData = array();

        //Check if file is uploaded and is valid
        if (Input::hasFile('file') && Input::file('file')->isValid()) {
            //Upload the file to below directory
            $destinationPath = 'user_files/csvs';
            $size = Input::file('file')->getSize();
            $fileName = Input::file('file')->getClientOriginalName();
            $mimeType = Input::file('file')->getMimeType();

            //Only csv file is permitted
            $mimesAccepted = array(
                'application/vnd.ms-excel',
                'text/csv',
                'text/plain'
            );

            //Max allowed file size is 2 MB
            $maxSize = 2097152;

            //Make sure that file being uploaded doesn't exceed max allowed size
            if ($size >= $maxSize || $size == 0) {
                session()->flash('err', 'File too large. File must be less than 2 MB.');
            }

            if (!in_array($mimeType, $mimesAccepted)) {
                session()->flash('err', 'Sorry, invalid file type. Only csv type is accepted.');
            } else {
                //Validate if file already exists
                if (file_exists("$destinationPath/" . $fileName)) {
                    session()->flash('err', $fileName . ' already exists.');
                } else {
                    Input::file('file')->move($destinationPath, $fileName);

                    //Grant access to uploaded file
                    //chmod($destinationPath . $fileName, 0666);

                    echo "Filed uploaded @: " . $destinationPath . '/' . $fileName . "<br />";

                    //Read csv file
                    $fh = fopen($destinationPath . '/' . $fileName, 'r+');
                    $lines = array();
                    $cnt = 0;

                    //Read csv files after successfully upload
                    while (($row = fgetcsv($fh, 8192)) !== FALSE) {
                        //Skip the first (header) line
                        if (0 == $cnt) {
                            if (
                                'date' != trim($row[0]) || 'category' != trim($row[1]) || 'lot title' != trim($row[2]) || 'lot location' != trim($row[3]) || 'lot condition' != trim($row[4]) || 'pre-tax amount' != trim($row[5]) || 'tax name' != trim($row[6]) || 'tax amount' != trim($row[7])
                            ) {
                                session()->flash('err', 'Invalid column names.');
                            }

                            $cnt++;
                            continue;
                        }

                        //Write csv data into database
                        DB::table('csv')->insert(
                            [
                                'csv_date' => date('Y-m-d', strtotime($row[0])),
                                'category' => trim($row[1]),
                                'lot_title' => trim($row[2]),
                                'lot_location' => trim($row[3]),
                                'lot_condition' => trim($row[4]),
                                'pre_tax_amount' => trim($row[5]),
                                'tax_name' => trim($row[6]),
                                'tax_amount' => trim($row[7]),
                            ]
                        );

                        //Populate array to display a report
                        $arrYearMonthKey = date('Y', strtotime($row[0]))
                                            . '-'
                                            . date('m', strtotime($row[0]));
                        $arrCategoryKey = trim($row[1]);
                        $categoryTotal = trim($row[5]) + trim($row[7]);

                        if (array_key_exists($arrYearMonthKey, $processedData)) {
                            if (array_key_exists($arrCategoryKey, $processedData[$arrYearMonthKey])) {
                                $processedData[$arrYearMonthKey][$arrCategoryKey] += $categoryTotal;
                            } else {
                                $processedData[$arrYearMonthKey][$arrCategoryKey] = $categoryTotal;
                            }
                        } else {
                            $processedData[$arrYearMonthKey][$arrCategoryKey] = $categoryTotal;
                        }
                    }
                }
            }
        } else {
            session()->flash('err', 'File is not uploaded or is invalid.');
        }

        if (!session()->has('err')) {
            ksort($processedData);

            session()->flash('msg', 'Successfully updated');
        }

        return view('csv/upload')->with('data', $processedData)
                ->with('results', 'Results:');
    }

}
