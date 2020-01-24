<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display Import Item Form
     * @param Request @request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('items.index');
    }

    /**
     * Parse file and display spending per-month and per-category
     * @param Request $request
     * @return Response
     */
    public function import(Request $request)
    {
        $this->validate($request, [
            'file-input' => 'required|mimes:csv,txt|max:10240',
        ]);

        $file = $request->file('file-input');
        
        $path = $file->getRealPath();

        $importData_arr = array();

        $fileData = array_map('str_getcsv', file($path));
        
        foreach(array_slice($fileData, 1) as $data) {
            $importData_arr[] = [
                'won_date'      => date('Y-m-d', strtotime($data[0])),
                'category'      => $data[1],
                'lot_title'     => $data[2],
                'lot_location'  => $data[3],
                'lot_condition' => $data[4],
                'pre_tax'       => $data[5],
                'tax_name'      => $data[6],
                'tax'           => $data[7]
            ];
        }
        Item::insert($importData_arr);

        //Fetch Spending per-month and per-category
        $items = DB::table('items')
                    ->groupBy(DB::raw("MONTHNAME(won_date)"))
                    ->groupBy('category')                 
                    ->select(DB::raw("MONTHNAME(won_date) as month"),'category', DB::raw('sum(tax) as amount'))
                    ->get();

        return view('items.display', ['items' => $items]);
    }
}
