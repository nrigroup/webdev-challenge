<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxe extends Model
{
    public function findOrCreate(string $searchTerm){
    	$taxe = \DB::table('taxes')->where('name', 'LIKE', "%{$searchTerm}%")->first();

    	if (is_null($taxe)) {
    		$taxe = new Taxe();
	    	$taxe->name = $searchTerm;
	    	$taxe->save();
    	}

    	return $taxe->id;
    }
}
