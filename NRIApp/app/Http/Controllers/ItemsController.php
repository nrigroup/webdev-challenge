<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;

class ItemsController extends Controller
{
    //from db
    public function getItems()
    {
        $items = Item::all();

        $spendingPerMonth = DB::select('select sum(taxAmount), strftime("%m", date) from items group by strftime("%m", date)');  
        $spendingPerCategory = DB::select('select sum(taxAmount), category from items group by category');   

        return view('welcome', [
            'spendingPerMonth' => json_encode($spendingPerMonth),
            'spendingPerCategory' => json_encode($spendingPerCategory)
        ]);
    }

    public function postItems()
    {
        Item::truncate(); //empty table

        $items = request('items');

        for ($i = 0; $i < count($items); $i++) {
            if (count($items[$i]) > 1) {
                $currentItem = $items[$i];
                $item = new Item();

                $date = $currentItem[0];
                $formattedDate = date("Y-m-d", strtotime($date));

                $item->date = $formattedDate;
                $item->category = $currentItem[1];
                $item->title = $currentItem[2];
                $item->location = $currentItem[3];
                $item->condition = $currentItem[4];
                $item->preTaxAmount = $currentItem[5];
                $item->taxName = $currentItem[6];
                $item->taxAmount = $currentItem[7];

                $item->save();
            }
        }
        return redirect('/');
    }
}
