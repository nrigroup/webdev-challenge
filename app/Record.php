<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'date',
        'category',
        'lot_title',
        'lot_location',
        'lot_condition',
        'pre_tax_amount',
        'tax_name',
        'tax_amount'
    ];
    protected $guard = [
            'id'
    ];
}
