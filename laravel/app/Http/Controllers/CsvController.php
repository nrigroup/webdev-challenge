<?php namespace App\Http\Controllers;

use View;
use Request;
use DB;
use App\csvAuctionLot;

//use Illuminate\Routing\Controller;

class CsvController extends Controller {

        protected $layout = 'layouts.main';

        /**
         * Constructor
         *
         * @access      public
         * @return      void
         *
         */
        public function __construct()
        {
                $this->middleware('guest');
        }

        /**
         * Show the Default CSV Page
         *
         * @access      public
         * @return      Response
         *
         */
        public function index()
        {
                return view('csv/upload');
        }

        /**
         * Parses Submitted CSV
         *
         * @access      public
         * @return      void
         *
         */
        public function parseData(Request $request)
        {   
            if(Request::hasFile('upload-csv'))
            {
                //Check if file can be read
                if (($handle = @fopen($_FILES['upload-csv']['tmp_name'], 'r')) !== FALSE) {
                    //Get headers
                    $headers = fgetcsv($handle);
                    //Assure file not empty
                    if($headers !== false){
                        while (($row = fgetcsv($handle)) !== FALSE) {
                            $data[] = array(
                                'date'=> date("Y-m-d",strtotime($row[0])),
                                'category'=> $row[1],
                                'lot_title'=> $row[2],
                                'lot_location'=> $row[3],
                                'lot_condition'=> $row[4],
                                'pre_tax_amount'=> $row[5],
                                'tax_name'=> $row[6],
                                'tax_amount'=> $row[7],
                            );
                        }
                    }else{
                        //TODO: Replace die statements with laravel error view page
                        die("File is Empty");
                    }
                    fclose($handle);
                }else{
                    die("Can't open file.");
                }
                //Truncate table for this task, since when testing don't want duplicate data
                csvAuctionLot::truncate();
                //Insert csv data
                $return = csvAuctionLot::insert($data); // Eloquent
                if($return){
                    //Redirect
                    return redirect()->route('results');
                }else{
                    die("Can't Insert Data.");
                }
            }
            // TODO: add some error handling if no data passed
        }
        /**
         * Show the  CSV uploaded results
         *
         * @access      public
         * @return      Response
         *
         */
        public function results()
        {       
                $data['sumByCategory'] = array();
                $data['sumByMonth'] = array();
                //Query For sum by category using query builder
                //SELECT category, sum(`pre_tax_amount`) as pre_tax_amount_sum, sum(`tax_amount`) as tax_amount_sum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total FROM `csv_auction_lots` WHERE 1 group by category
                $qCategories = DB::table('csv_auction_lots')
                    ->select(DB::raw('category, sum(`pre_tax_amount`) as pre_tax_amount_sum, sum(`tax_amount`) as tax_amount_sum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total'))
                    ->groupBy('category')
                    ->get();
                if($qCategories->count()){
                    $data['sumByCategory'] = $qCategories->toArray();
                }
                DB::enableQueryLog();
                //Query For sum by month using query builder
                //SELECT MONTH(date) as month, YEAR(date) AS year, sum(`pre_tax_amount`) as pre_tax_amount_sum, sum(`tax_amount`) as tax_amount_sum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total FROM `csv_auction_lots` WHERE 1 group by year, month order by year, month
                $qMonths = $qCategories = DB::table('csv_auction_lots')
                    ->select(DB::raw('MONTH(date) as month, YEAR(date) AS year, sum(`pre_tax_amount`) as pre_tax_amount_sum, sum(`tax_amount`) as tax_amount_sum, sum(`pre_tax_amount`) + sum(`tax_amount`) as total'))
                    ->groupBy('year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->get();
                if($qMonths->count()){
                    $data['sumByMonth'] = $qMonths->toArray();
                }
                return view('csv/results', $data);
        }
} // end of class