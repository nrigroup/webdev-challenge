<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
		$lots = \App\Lot::orderBy('id', 'desc')->with('category')->with('uploader')->with('source')->with('tax')->paginate();
        $cats = \App\LotCategory::get();
        $files=\App\File::get();
        return view('admin/lot/lot_list', ['lots' => $lots,'cats'=>$cats,'files'=>$files]);
		
    }

    /**
     * Display a listing of filtered lots .
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $lots = \App\Lot::orderBy('id', 'desc');
        if($request->category_id){
            $lots=$lots->where('category_id',$request->category_id);
        }
        if($request->file_id){
            $lots=$lots->where('file_id',$request->file_id);
        }
        if($request->from){
            $lots=$lots->where('date','>=',$request->from);
        }
        if($request->to){
            $lots=$lots->where('date','<=',$request->to);
        }
        if($request->keyword){
            $lots=$lots->where('title','like','%'.$request->keyword.'%');
        }
        $lots=$lots->with('category')->with('uploader')->with('source')->with('tax')->get();
        return view('admin/lot/lot_filter_list', ['lots' => $lots]);
        
    }

    /**
     * Show the form for creating a new lot.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lot = new \App\Lot;
        $cats = \App\LotCategory::get();
        $taxes = \App\Tax::get();
        return view('admin/lot/lot_form', [
            'lot' => $lot,
            'cats' => $cats,
            'taxes' => $taxes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
		$lot=new \App\Lot();
		$lot->title=$request->title;
        $lot->condition=$request->condition;
        $lot->category_id=$request->category_id;
        $lot->location=$request->location;
        $lot->tax_id=$request->tax_id;
        $lot->tax_amount=$request->tax_amount;
        $lot->pre_tax=$request->pre_tax;
		$lot->date=$request->date;
        $lot->uploader_id=Auth::id();
		$lot->save();
        return redirect('lot')->withSuccess('The lot has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lot = \App\Lot::findOrFail($id);
        $cats = \App\LotCategory::get();
        $taxes = \App\Tax::get();
        return view('admin/lot/lot_form', [
            'lot' => $lot,
            'cats' => $cats,
            'taxes' => $taxes,
        ]);
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
        $lot = \App\Lot::findOrFail($id);
		$lot->title=$request->title;
        $lot->condition=$request->condition;
        $lot->category_id=$request->category_id;
        $lot->location=$request->location;
        $lot->tax_id=$request->tax_id;
        $lot->tax_amount=$request->tax_amount;
        $lot->pre_tax=$request->pre_tax;
        $lot->date=$request->date;
        $lot->uploader_id=Auth::id();
		$lot->save();
		return redirect('lot')->withSuccess('The lot has been saved');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lot = \App\Lot::findOrFail($id);
		
		$lot->delete();

        return redirect()->back()->withSuccess('The lot has been deleted');
    }
}
