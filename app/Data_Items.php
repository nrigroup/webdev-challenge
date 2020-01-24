<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_Items extends Model
{
    //csv model 
    Protected $fillable  = ['date','category','lot_title','lot_location','lot_condition','pre_tax_amount','tax_name','tax_amount' ];

}
