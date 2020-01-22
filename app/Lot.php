<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Lot extends Model
{
    protected $fillable = [
        'date_won',
        'category',
        'lot_condition',
        'lot_title',
        'lot_location',
        'pretax_amount',
        'tax_name',
        'tax_amount'
    ];

    public function getDateWonAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }


    public function path()
    {
        return route('lots.show', $this);
    }
}
