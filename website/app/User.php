<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email','password','name'];
	
	public function files(){
		return $this->hasMany('App\File','owner_id','id');
	}
	public function lots(){
		return $this->hasMany('App\Lot','uploader_id','id');
	}

}
