<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tax';
	
	public function lots(){
		return $this->hasMany('App\Lot','tax_id','id');
	}
	
}
