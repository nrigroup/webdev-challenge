<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    protected static function totals(){
    	return Item::select('category', DB::raw('SUM(pre_tax_amount) as total'))
                ->groupBy('category')
                ->get();
    }
}
