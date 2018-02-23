<?php

namespace App\Http\Traits;
use App\Lot;

trait LotTrait
{
    public function storeLot($data){
        
			$lot = new Lot;
			 list($lotDate, $lot->category, $lot->lot_title, $lot->lot_location, $lot->lot_condition,
                $lot->pre_tax_amount, $lot->tax_name, $lot->tax_amount) = str_getcsv($data,',');
            $lot->date = date( 'Y-m-d', strtotime($lotDate) );
			return $lot;
        
    }
}