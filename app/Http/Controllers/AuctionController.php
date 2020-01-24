<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuctionData;
use Illuminate\Support\Facades\Storage;
use App\Libraries\Csv;

class AuctionController extends Controller
{
    public function index()
    {
        return view('auction.index');
    }

    public function importCSV(Request $request)
    {
        $file = Storage::disk('local')->put('public', $request->file('auction_data'));
        $file_url = Storage::url($file);

        $csv = new Csv();
        $csv_file = $csv->read($file_url);

        $insert_auction = new AuctionData();
        $insert_auction->store_csv($csv_file);

        return redirect()->route('auction_total_spending');
    }

    public function totalSpending()
    {
        $auction_data = new AuctionData();
        $all_auctions = $auction_data->getAllAuctions();

        return view('auction.result', [
            'all_auctions' => $all_auctions
        ]);
    }
}
