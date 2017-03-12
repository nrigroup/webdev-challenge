<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotCategory extends Model
{
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lot_category';
	
	public function parent(){
		return $this->belongsTo('App\LotCategory','parent_id','id');
	}
	
	public function lots(){
		return $this->hasMany('App\Lot','category_id','id');
	}
	
}
