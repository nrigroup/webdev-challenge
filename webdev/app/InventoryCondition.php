<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCondition extends Model
{
    /**
     * This attribute defines table name.
     */
    protected $table = 'inventory_condition';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'inventory_condition'
    ];
}
