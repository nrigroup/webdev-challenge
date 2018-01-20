<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotRequest;
use App\Models\Item;
use App\Models\Lot;
use DB;

class ItemController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'category', 'lot_location', 'lot_condition', 'pre_tax_amount',
        'tax_name', 'tax_amount'
    ];

    public function create()
    {
        return view('items.create');
    }

    public function store(LotRequest $request)
    {
        $csv = $request->file('item_file');
        $fh = fopen($csv->getRealPath(), "r");
        $first_row = true;

        DB::beginTransaction();
        $lot = new Lot;
        $lot->save();
        while (($rowData = fgetcsv($fh, 0, "\n", '"')) !== FALSE) {
            if ($first_row) {
                $first_row = false;
                continue;
            }

            $item = new Item;

            //data is sanitized on display
            list($itemDate, $item->category, $item->lot_title, $item->lot_location, $item->lot_condition,
                $item->pre_tax_amount, $item->tax_name, $item->tax_amount) = str_getcsv( $rowData[0],',');
            $item->date = date( 'Y-m-d', strtotime($itemDate) );

            if (!$lot->lotItems()->save($item)) {
                return redirect('/')->withErrors('There was a problem importing the current lot.  
                    Please contact your administrator.');
                DB::rollBack();
            }
        }
        DB::commit();
        fclose($fh);
        return redirect('/lot/view/'.$lot->id)->with('Lot Successfully Saved.');
    }
}
