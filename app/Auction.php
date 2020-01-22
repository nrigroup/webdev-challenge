<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'date', 'category', 'lot_title', 'lot_location', 'lot_condition' ,'pretax_amount', 'tax_name', 'tax_amount'
    ];
}
