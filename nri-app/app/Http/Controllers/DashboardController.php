<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($month = null, $year = null) {

        $auctionItems = Auction::all();
        $itemsByCat = array();
        $categories = array();
        $spendingByCat = array();
        $preTaxByCat = array();

        // Set default month and year
        if (!isset($month) || !isset($year)) {
            $month = date('m', strtotime($auctionItems[0]->date));
            $year = date('Y', strtotime($auctionItems[0]->date));
        }

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

        $categories = array_keys($itemsByCat);

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
        
        $data = [
            'month' => $month,
            'year' => $year,
            'categories' => $categories,
            'itemsByCat' => $itemsByCat,
            'spendingByCat' => $spendingByCat,
            'preTaxByCat' => $preTaxByCat
        ];
        
        // dd($data);

        return view('dashboard.dashboard', $data);
    }

    public function submit(Request $request) {
        // dd($request);
        $month = $request->input('monthFilter');
        $year = $request->input('yearFilter');

        return redirect()->route('dashboardPage', ['month' => $month, 'year' => $year]);
    }
}
