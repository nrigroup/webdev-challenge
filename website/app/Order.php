<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
		 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order';
    public function user(){
		return $this->belongsTo('App\User','userId','id');
	}
	public function truck(){
		return $this->belongsTo('App\Truck','truckId','id');
	}
	public function menu(){
		return $this->belongsTo('App\Menu','menuId','id');
	}
	public function comments(){
		return $this->hasMany('App\Comment','regardingTo','id');
	}
}
