<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lot extends Model
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
     * Get the items for the lot.
     */
    public function lotItems()
    {
        return $this->hasMany('App\Models\Item');
    }

    /**
     * Get the Total Spending Amount By Category or By Month.
     */
    public function spendingAmount($type = 'month')
    {
        if (!in_array($type, array('month', 'category'))) {
            return array();
        }
        $lotItems = $this->groupLotItems($type);

        $spending = [];
        $total = 0;
        foreach ($lotItems as $key => $items) {
            $spending[$key] = $items->sum('pre_tax_amount')+$items->sum('tax_amount');
            $total += $spending[$key];
        }

        if (!empty($spending))
        {
            $spending = $this->sortSpendingKeys($spending, $type);
            $spending['Total'] = $total;
        }
        return $spending;
    }

    /**
     * Get the Get the Tax Balance by either pre_tax_amount or tax_amount.
     */
    public function sumTaxBalance($type = 'tax_amount')
    {
        if (!in_array($type, array('tax_amount', 'pre_tax_amount'))) {
            return 0;
        }
        return $this->lotItems->sum($type);
    }

    /**
     * Group up the lot items by a key.
     */
    public function groupLotItems($key = 'month')
    {
        $lotItems = collect();
        if ($key == 'month') {
            $lotItems = $this->lotItems->groupBy(function($item) {
                return $item->date->format('Y-m');
            });
        } else if ($key == 'category') {
            $lotItems = $this->lotItems->groupBy('category');
        }
        return $lotItems;
    }

    /**
     * Sort spending array by a key.
     */
    public function sortSpendingKeys($spending, $key = 'month')
    {
        if ($key == 'month') {
            uksort($spending, function ($a, $b) {
                return strtotime($a) - strtotime($b);
            });
        } else if ($key == 'category') {
            ksort($spending);
        }
        return $spending;
    }
}
