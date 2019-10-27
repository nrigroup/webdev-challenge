<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    /**
     * This attribute defines table name.
     */
    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date', 'category_id', 'lot_title', 'lot_location', 'lot_condition_id', 'tax_name','tax_amount'
    ];
}
