<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class AuctionData extends Model
{
    protected $table = 'auction_data';

    public function store_csv($csv_file)
    {
        foreach($csv_file as $ind => $csv_content_array){
            $result[] = $this->store($csv_content_array);
        }

        return $result;
    }

    public function store($csv_content)
    {
        $insert_auction = new $this;
        $insert_auction->date = $csv_content[0];
        $insert_auction->category = $csv_content[1];
        $insert_auction->lot_title = $csv_content[2];
        $insert_auction->lot_location = $csv_content[3];
        $insert_auction->lot_condition = $csv_content[4];
        $insert_auction->pre_tax_amount = $csv_content[5];
        $insert_auction->tax_name = $csv_content[6];
        $insert_auction->tax_amount = $csv_content[7];
        $insert_auction->save();

        return $insert_auction;
    }

    public function getAllAuctions()
    {
        $auction_data = AuctionData::select()
        ->orderBy('date', 'asc')
        ->get()
        ->map(function($auction_data){

            $auction_data->month_year = Carbon::parse($auction_data->date)->format('m-Y');

            return $auction_data;
        });

        return $auction_data;
    }
}
