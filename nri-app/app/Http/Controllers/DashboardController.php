<?php

namespace App\Http\Controllers;

use App\Auction;
use Mockery\Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($month = null, $year = null) {

        try {
            // Retrieve auction items from db
            $auctionItems = Auction::all();
            $itemsByCat = array();
            $categories = array();
            $spendingByCat = array();
            $preTaxByCat = array();
    
            // Set default month and year to first item
            if (!isset($month) || !isset($year)) {
                $month = date('m', strtotime($auctionItems[0]->date));
                $year = date('Y', strtotime($auctionItems[0]->date));
            }
    
            // Filter by month & year
            foreach ($auctionItems as $item) {
                $itemDate = strtotime($item->date);
                $dateM = date('m', $itemDate);
                $dateY = date('Y', $itemDate);
                $category = $item->category;
    
                if (!isset($itemsByCat[$category])) {
                    $itemsByCat[$category] = [];
                }
                
                if ($dateM == $month && $dateY == $year) {
                    array_push($itemsByCat[$category], $item);
                }
            }
    
            // PHP array keys act like a set of unique entries
            $categories = array_keys($itemsByCat);
    
            // Determine spending amounts
            foreach($categories as $category) {
                $spendingByCat[$category] = [];
                $preTaxByCat[$category] = [];
                $totalSpend = 0;
                $preTaxSpend = 0;
    
                foreach($itemsByCat[$category] as $item) {
                    $preTaxSpend += $item->pre_tax_amount;
                    $totalSpend += $item->pre_tax_amount + $item->tax_amount;
                }
    
                $spendingByCat[$category] = $totalSpend;
                $preTaxByCat[$category] = $preTaxSpend;
            }
            
            // Data to inject into blade template
            $data = [
                'month' => $month,
                'year' => $year,
                'categories' => $categories,
                'itemsByCat' => $itemsByCat,  // Might need this for bonus features
                'spendingByCat' => $spendingByCat,
                'preTaxByCat' => $preTaxByCat
            ];
            
            // dd($data);
    
            // Render dashboard page
            return view('dashboard.dashboard', $data);

        } catch (Exception $ex) {
            abort(500); // Internal server error
        } 
    }

    public function submit(Request $request) {

        try {
            // Collect form filters data
            $month = $request->input('monthFilter');
            $year = $request->input('yearFilter');

            // Construct get request for dashboard page WITH params
            return redirect()->route('dashboardPage', ['month' => $month, 'year' => $year]);

        } catch (Exception $ex) {
            abort(500); // Internal server error
        }
    }
}
