<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
              'date','category','lot_title','lot_location','lot_condition','lot _condition','pre_tax_amount','tax_name','tax_amount',
           ];
}
