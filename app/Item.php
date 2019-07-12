<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title','purchase_date','pre_tax_amount',
        'tax_amount','address','category_id',
        'tax_type_id','condition_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function taxType()
    {
        return $this->belongsTo(TaxType::class);
    }
}
