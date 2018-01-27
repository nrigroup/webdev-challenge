<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotSet extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
	
	/**
     * Get the lots for this set
     */
    public function lots()
    {
        return $this->hasMany('App\Lot');
    }
}
