<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static insert($toArray)
 * @method static getSpending()
 */
class Inventory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get Total spending amount per-month and per-category
     *
     * @param        $query
     *
     * @param string $uid
     *
     * @return array
     */
    public function ScopeGetSpending($query, $uid = NULL)
    {
        if (is_null($uid)) {
            return [];
        }

        $query = "
                SELECT Month(date) as mth,
                       Year(date) as year,
                       category,
                       MAX(pre_tax) as highest,
                       SUM(pre_tax + tax_amount) as spending_amount
                FROM 
                     inventories
                WHERE uid = '{$uid}'
                GROUP BY 
                     year,
                     mth,
                     category 
                ORDER BY 
                    category,
                    year,
                    mth";

        // Run Raw query against database
        $result = DB::select(DB::raw($query));

        $items = [];

        /**
         * Group Items by Category
         */
        foreach ($result as $item) {
            // Set Items into Category
            $items[$item->category][] = $this->iterateItem($item);
        }

        return $items;
    }

    /**
     * Iterate Item with Month year
     *
     * @param $item
     *
     * @return array
     */
    private function iterateItem($item)
    {
        if (!$item) {
            return [];
        }
        // format display date to be [July 2019]
        $parse = sprintf('%s-%s-%s', $item->year, $item->mth, 1);
        $month_year = Carbon::parse($parse)->format('F Y');
        $item->month_year = $month_year;

        // format Spending amount to currency
        $item->spending_amount = number_format($item->spending_amount, 2);

        return $item;
    }
}
