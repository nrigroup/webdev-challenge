<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function calculate_total_amount($category_id)
    {
        $lots = \DB::table('lots')->where('categorie', 'LIKE', "%{$category_id}%")->get();
        $total = 0;
        foreach ($lots as $lot){
            $total += $lot->pre_taxe_amount + $lot->taxe_amount;
        }
        return $total;
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
