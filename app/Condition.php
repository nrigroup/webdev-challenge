<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    public function lot()
    {
    	return $this->belongsTo(Lot::class);
    }

    public function findOrCreate(string $searchTerm){
    	$condition = \DB::table('conditions')->where('title', 'LIKE', "%{$searchTerm}%")->first();

    	if (is_null($condition)) {
    		$condition = new Condition();
	    	$condition->title = $searchTerm;
	    	$condition->save();
    	}

    	return $condition->id;
    }
}
