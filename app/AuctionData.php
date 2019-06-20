<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AuctionData extends Model
{   
    protected $fillable = ['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'pre_tax_amount', 'tax_name', 'tax_amount'];
}
