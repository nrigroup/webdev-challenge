<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    public function index()
    {

        $content = DB::select('SELECT  date_format(date,\'%Y-%m\') as yyyymm, category, SUM(tax_amount) as amount
                                            FROM Data
                                            WHERE date_format(date,\'%Y-%m\') < date_format(now(),\'%Y-%m\') 
                                            GROUP BY category, date_format(date,\'%Y-%m\')
                                            ORDER BY category, yyyymm DESC;');

        return [table_content => $content];
    }
}
