<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class ReportController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dashboard::all();

        return view('dataview', compact('data'));
    }

    /**
     * Add new data in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data = new Dashboard();
        $taxName = NULL;
        $taxAmount = 0;
        if ($request->filled('tax_name')) {
            $taxName =  $request['tax_name'];
        }
        if ($request->filled('tax_amount')) {
            $taxAmount =  $request['tax_amount'];
        }

        // Storing Data
        $data['date'] = str_replace('-','/',$request['date']);
        $data['date'] = date("m/d/Y", strtotime($data['date']));
        $data['category'] = $request['category'];
        $data['lot title'] = $request['lot_title'];
        $data['lot location'] = $request['lot_location'];
        $data['lot condition'] = $request['lot_condition'];
        $data['pre-tax amount'] =  $request['pre-tax_amount'];
        $data['tax name'] = $taxName;
        $data['tax amount'] = $taxAmount;

        $data->save();
        return back();
    }

    /**
     * Remove data in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Dashboard::find($id);
        $data->delete();

        return back();
    }
}
