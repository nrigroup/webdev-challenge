<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // sql query to retrieve data: month, year, category, total amount per month and per category
        $getChallengeData  = DB::select(DB::raw("select month(date) as month, year(date) as year, category, sum(pre_tax_amount) as total_amount from challenges group by year(date), month(date), category"));
        return view('challenge')->with('getChallengeData', $getChallengeData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'upload-file' => 'required|mimes:csv,txt'
        ]);
        // get file from view
        $uploadFile = $request->file('upload-file');

        // get path of the file
        $filePath = $uploadFile->getRealPath();

        // open file on read mode
        $file = fopen($filePath, 'r');

        // get header row of csv file
        $header = fgetcsv($file);

        // flag value by default set 0
        $flag = 0;

        // check header is present or not
        // check header columns are in order
        if ($header[0] == "date" && $header[1] == "category" && $header[2] == "lot title" && $header[3] == "lot location" &&
            $header[4] == "lot condition" && $header[5] == "pre-tax amount" && $header[6] == "tax name" && $header[7] == "tax amount") {

            // initialize increment
            $row = 1;

            // looping other rows of the csv file
            // checks data exists or not in csv
            while (($columns = fgetcsv($file, 1000, ',')) !== FALSE) {
                $row++;

                // check all columns have data or not
                if (!empty($columns[0]) && !empty($columns[1]) && !empty($columns[2]) && !empty($columns[3]) &&
                    !empty($columns[4]) && !empty($columns[5]) && !empty($columns[6]) && !empty($columns[7])) {

                    // store csv rows data into array
                    // only successful validated rows are stored into array
                    $readyToInsertData[] = [
                        'date' => Carbon::createFromFormat('m/d/Y', $columns[0])->format('Y-m-d'),
                        'category' => $columns[1],
                        'lot_title' => $columns[2],
                        'lot_location' => $columns[3],
                        'lot_condition' => $columns[4],
                        'pre_tax_amount' => $columns[5],
                        'tax_name' => $columns[6],
                        'tax_amount' => $columns[7],
                    ];
                }
            }
            // check all the rows are successfully inserted or not into array
            // size of the array == number of rows of csv - header row
            if (isset($readyToInsertData) && (sizeof($readyToInsertData) == $row - 1)) {

                // if all the csv data stored into array without any error then insert data into database
                Challenge::insert($readyToInsertData);

                // set flag value to 1
                $flag = 1;
            }
        }
        return $flag == 1 ? redirect('/')->with('success', 'Data Saved') : redirect('/')->with('error', 'Data not saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
