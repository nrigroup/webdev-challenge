<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxType extends Model
{
    protected $fillable = [
        'title'
    ];
    protected $table = 'tax_types';

    public function items(){
        return $this->hasMany(Item::class);
    }
}
