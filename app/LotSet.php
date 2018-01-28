<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotSet extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
	
	/**
     * Get the lots for this set
     */
    public function lots()
    {
        return $this->hasMany('App\Lot');
    }
	
	public function totalSpendingByMonth()
	{
		$lots = collect([]);
		$lots = $this->lots->groupBy(function($lot) {
                return $lot->date->format('Y-m');
            });
		$totalSpent = [];
		foreach ($lots as $month => $lot) {
            $totalSpent[$month] = $lot->sum('pre_tax_amount')+$lot->sum('tax_amount');
        }
		return $this->getTotal($lots);
		
	}
	
	public function totalSpendingByCategory()
	{
		$lots = $this->lots->groupBy('category');
		return $this->getTotal($lots);
		
	}
	public function getTotal($lots){
		$totalSpent = [];
		foreach ($lots as $hash => $lot) {
            $totalSpent[$hash] = $lot->sum('pre_tax_amount')+$lot->sum('tax_amount');
        }
		return $totalSpent;
	}
}
