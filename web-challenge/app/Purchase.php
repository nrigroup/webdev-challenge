<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $table = 'csv_data';
    public $fillable = ["date","category","lot_title","lot_location","lot_condition","pre_tax_amount","tax_name","tax_amount"];
}
