<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = false;
    public $fillable=['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'pre_tax_amount', 'tax_name', 'tax_amount', 'auction_name'];
    
    //model relationship
    public function auction(){
        return $this->belongsTo('App\Auction');
    }
}
