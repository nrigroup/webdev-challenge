<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];


    /**
     * Get the items of each category
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
