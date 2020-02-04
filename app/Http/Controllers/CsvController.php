<?php

namespace App\Http\Controllers;

use App\Imports\ItemsImport;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class CsvController extends Controller
{
    //Processing CSV file using EXCEl package
    public function upload(\Illuminate\Http\Request $request){
        Excel::import(new ItemsImport, request()->file('csvfile'));
        Session::put('success','File has been Imported Successfully' );
        return redirect("/");
    }

    //Getting dataframe for charts (Amount per month)
    public function getMonthlyData(){
        $amtMonthlyCollection = Item::all('date','pre_tax_amount','tax_amount')
            ->groupby(function($val) {
                return Carbon::parse($val->date)->format('Y-M');
            });
        $months = [];
        $amounts = [];
        $sum = 0;

        //Processing Collection to get individual numbers(month and sale-sums) for chart
        foreach ($amtMonthlyCollection as $eachMonth) {
            foreach ($eachMonth as $eachDate){
                $sum = $sum + $eachDate->pre_tax_amount + $eachDate->tax_amount;
            }
            array_push($amounts, round($sum, 2));
            array_push($months,Carbon::parse($eachMonth[0]->date)->format('Y-M'));
            $sum=0;
        }
        return [$months,$amounts];

    }

    //Getting dataframe for charts (Amount per Category)
    public function getCategoryData(){
        $amtCategoryCollection = Item::all('category','date','pre_tax_amount','tax_amount')
            ->groupby('category');
        $categories = [];
        $amounts = [];
        $sum = 0;

        //Processing Collection to get individual numbers(month and sale-sums) for chart
        foreach ($amtCategoryCollection as $eachCategory) {
            foreach ($eachCategory as $eachRow){
                $sum = $sum + $eachRow->pre_tax_amount + $eachRow->tax_amount;
            }
            array_push($amounts, round($sum, 2));
            array_push($categories, $eachCategory[0]->category);
            $sum=0;
        }
        return [$categories,$amounts];

    }
}
