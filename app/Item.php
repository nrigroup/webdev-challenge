<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // set fillable fields
    protected $fillable = ['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'tax_name', 'tax_amount'];
}
