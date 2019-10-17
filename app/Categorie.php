<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function lot()
    {
    	return $this->belongsTo(Lot::class);
    }

    public function findOrCreate(string $searchTerm){
    	$categorie = \DB::table('categories')->where('name', 'LIKE', "%{$searchTerm}%")->first();

    	if (is_null($categorie)) {
    		$categorie = new Categorie();
	    	$categorie->name = $searchTerm;
	    	$categorie->save();
    	}

    	return $categorie->id;
    }
}
