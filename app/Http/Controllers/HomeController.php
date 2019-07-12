<?php

namespace App\Http\Controllers;


use App\Category;
use App\Item;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Get total money spent per month
        $monthlySpending = DB::table('items')
            ->select(DB::raw('year(purchase_date) as year, month(purchase_date) as month, SUM(pre_tax_amount + tax_amount) as amount'))
            ->groupBy(DB::raw('year(purchase_date)'))
            ->groupBy(DB::raw('month(purchase_date)'))
            ->get();

        //Get total money spent per category
        $categories = DB::table('items')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->select(DB::raw('categories.id, categories.title, SUM(items.pre_tax_amount + items.tax_amount) AS total_spending'))
            ->groupBy('categories.id')
            ->get();

        return view('home', [
            'categories' => $categories,
            'monthlySpending' => $monthlySpending
        ]);
    }
}