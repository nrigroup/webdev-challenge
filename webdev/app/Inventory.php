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
        'date', 'category', 'lot_title', 'lot_location', 'lot_condition','pre_tax_amount', 'tax_name','tax_amount'
    ];
}
