<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * @package App
 */
class Item extends Model
{
    /**
     * Make all fields fillable
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Get the category of the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }

    /**
     * Set the date to date format.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Get total price of item
     *
     * Total price include the sum of amount_pre_tax and tax_amount
     *
     * @param  string  $value
     * @return void
     */
    public function getTotalPriceAttribute()
    {
        return $this->amount_pre_tax + $this->tax_amount;
    }
}
