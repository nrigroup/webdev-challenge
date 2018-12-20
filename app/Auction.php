<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    //
    public $primaryKey = 'filename';
    public $timestamps = true;
    
    public $fillable = ['filename'];


    //model relationship
    public function products(){
        return $this->hasMany('App\Product');
    }
}
