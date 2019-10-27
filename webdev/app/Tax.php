<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    /**
     * This attribute defines table name.
     */
    protected $table = 'tax';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tax_name', 'tax_rule'
    ];
}
