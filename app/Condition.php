<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    protected $fillable = [
        'title'
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }
}
