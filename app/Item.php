<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    protected $fillable = array(
    	'uploadid', 'date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'pretax_amount', 'tax_name', 'tax_amount'
    );
    public $timestamps = false;

    public function item() {
    	return $this->belongsTo('Upload','uploadid');
    }
}
