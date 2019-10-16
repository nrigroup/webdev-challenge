<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function lot()
    {
    	return $this->belongsTo(Lot::class);
    }
}
