<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'category' ,'lot_title', 'lot_location', 'lot_condition',
        'pre_tax_amount', 'tax_name', 'tax_amount'
    ];

    /**
     * Get the lot for the item.
     */
    public function lot()
    {
        return $this->belongsTo('App\Models\Lot');
    }
}
