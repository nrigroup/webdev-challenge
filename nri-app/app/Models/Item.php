<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        "date",
        "category",
        "lot title",
        "lot location",
        "lot condition",
        "pre-tax amount",
        "tax name",
        "tax amount"
    ];
}
