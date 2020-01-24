<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Table extends Model
{

    public static function fetchData()
    {

        $content = DB::select('SELECT  date_format(date,\'%Y-%m\') as yyyymm, category, SUM(tax_amount) as amount
                                            FROM Data
                                            WHERE date_format(date,\'%Y-%m\') < date_format(now(),\'%Y-%m\') 
                                            GROUP BY category, date_format(date,\'%Y-%m\')
                                            ORDER BY category, yyyymm DESC;');

        return $content;
    }
}
