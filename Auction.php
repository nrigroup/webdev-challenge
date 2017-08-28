<?php

    namespace App;
    use Illuminate\Database\Eloquent\Model;
    
    class Auction extends Model
    {
       public $fillable = ['date','category', 'lot_title','lot_location', 'lot_condition','pre_tax_amount','tax_name','tax_amount'];
    }

