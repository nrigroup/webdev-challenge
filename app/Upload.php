<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = "uploads";
    protected $fillable = array('timestamp', 'filename', 'userID');
    public $timestamps = false;

    public function items() {
    	return $this->hasMany('App\Item', 'uploadid');
    }
}
