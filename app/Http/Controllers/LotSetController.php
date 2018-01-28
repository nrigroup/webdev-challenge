<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\LotTrait;
use App\LotSet;

class LotSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotSets = LotSet::all();
		return view('viewHistory')->with('lotSets', $lotSets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
		use LotTrait;
    public function store(Request $request)
    {
        $csv = $request->file('file');
		$lotSet = new LotSet;
        $lotSet->save();
		$first_row = true;
		
		$fh = fopen($csv->getRealPath(), "r");
		 while (($rowData = fgetcsv($fh, 0, "\n", '"')) !== FALSE) {
			 if ($first_row) {
                $first_row = false;
                continue;
            }
			
			  $lotSet->lots()->save($this->storeLot($rowData[0]));
		 }
		 return('lotset/show/' . $lotSet->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lotSet = LotSet::with('Lots')->findOrFail($id);
		//$totalSpendingCategory = $lotSet->totalSpending('category');
		return view('viewLotSet')
			->with('spentMonthly', $lotSet->totalSpendingByMonth())
			->with('spentByCategory', $lotSet->totalSpendingByCategory())
			->with('lotSet', $lotSet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
