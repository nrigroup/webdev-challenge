<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    public function owner(){
		return $this->belongsTo('App\User','owner_id','id');
	}
	public function lots(){
		return $this->hasMany('App\Lot','file_id','id');
	}
}
