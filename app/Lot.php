<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];
	/**
     * Get the lotSet for the lot.
     */
    public function lot()
    {
        return $this->belongsTo('App\LotSet');
    }
}
