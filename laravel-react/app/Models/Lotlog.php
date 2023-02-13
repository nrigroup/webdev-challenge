<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotlog extends Model
{
    protected $fillable = ['date', 'category', 'lot_title', 'lot_location', 'lot_condition', 'pre_tax_amount', 'tax_name', 'tax_amount'];
    protected $table = 'lotlogs';
    use HasFactory;
}
