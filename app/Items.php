<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    protected $table = "items";
    protected $fillable = ['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'pre_tax_amt', 'tax_name', 'tax_amt'];
    public $timestamps = false;
}
