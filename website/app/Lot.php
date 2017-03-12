<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lot';
    public function category(){
		return $this->belongsTo('App\LotCategory','category_id','id');
	}
	public function tax(){
		return $this->belongsTo('App\Tax','tax_id','id');
	}
	public function uploader(){
		return $this->belongsTo('App\User','uploader_id','id');
	}
}
