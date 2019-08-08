<?php

namespace App\Http\Controllers;

use App\Category;
use App\Imports\CategoryImport;
use App\Imports\LotImport;
use App\Item;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Import records from CSV to database
     *
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        //first insert categories into categories table
        Excel::import(new CategoryImport(), request()->file('file'));

        // insert items into items table
        Excel::import(new LotImport(), request()->file('file'));

        return back();
    }

    /**
     * Return home view with amounts per month per category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $allCats = Category::all();

        // Stote items in array with category as a key and month, total price as value
        $items =[];
        foreach ($allCats as $cat) {
            $months =  $cat->items->groupBy(function($item) {
                        return Carbon::parse($item->date)->format('m/Y');
                    })->map(function ($row) {
                        return $row->sum('total_price');
                    })->sort('date')
                        ->toArray();

            // make array to easily access in view blade
            foreach ($months as $month => $total_price) {
                $row['month'] = $month;
                $row['category'] = $cat->category;
                $row['price'] = $total_price;
                $items[] = $row;
            }
        }

        // sort according to month and year
        usort($items, function($a, $b) {
            return Carbon::createFromFormat('m/Y', $a['month'])->timestamp <=> Carbon::createFromFormat('m/Y', $b['month'])->timestamp;
        });

        return view('home',['items' => $items]);
    }
}
