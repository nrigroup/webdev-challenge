<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Models an Inventory item
 */
class Inventory extends Model
{
    /**
     * attributes that cant be mass assigened
     * @var array
     */
    protected $guarded = [];

    /**
     * attributes that are hidden in response
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];


    /**
     * groups Inventory items by month/year format
     * @return array array of format [date, [Inventory]]
     */
    static function groupByMonth()
    {
        $ordered = static::orderBy('date')->get();
        $grouped = [];

        foreach ($ordered as $item) {
            $parsed = date_parse($item->date);
            $date = $parsed['month'] . '/' . $parsed['year'];
            if(!array_key_exists($date, $grouped)) {
                $grouped[$date] = [];
            }
            array_push($grouped[$date], $item);
        }
        return $grouped;
    }

    /**
     * groups Inventory items by category
     * @return array array of format [category, [Inventory]]
     */
    static function groupByCategory()
    {
    	$ordered = static::orderBy('category')->get();
    	$grouped = [];

    	foreach ($ordered as $item) {
    		$category = $item->category;
    		if(!array_key_exists($category, $grouped)) {
    			$grouped[$category] = [];
    		}
			array_push($grouped[$category], $item);
    	}
    	return $grouped;
    }

    /**
     * gets total cost of Inventory item
     * @return number the total cost
     */
    function getTotalCost()
    {
    	return $this->pre_tax + $this->tax_amount;
    }

    /**
     * gets the total cost of a given category
     * @param  string $category the category
     * @return number           the total amount
     */
    static function getCategoryCost($category)
    {
    	$items = static::where('category', $category)->get();
    	$total = 0;
    	foreach ($items as $item) {
    		$total += $item->getTotalCost();
    	}
    	return $total;
    }

    /**
     * gets the total cost of a given month/year
     * @param  string $category the month in format month/year
     * @return number           the total cost
     */
    static function getMonthlyCost($month)
    {
    	$items = static::where('category', $category)->get();
    	$total = 0;
    	foreach ($items as $item) {
    		$total += $item->getTotalCost();
    	}
    	return $total;
    }
}
