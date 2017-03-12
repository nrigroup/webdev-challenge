<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class taxController extends Controller
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
    public function index()
    {
        $taxes = \App\Tax::orderBy('id', 'desc')->paginate();
        return view('admin/tax/tax_list', ['taxes' => $taxes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tax = new \App\Tax;
        //$parents = \App\LotCategory::where('id','!=',Auth::id())->where('parent_id','!=',Auth::id())->get();
        return view('admin/tax/tax_form', [
            'tax' => $tax
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
        $tax=new \App\Tax;
        $tax->name=$request->name;
        $tax->description=$request->description;

        $tax->save();
        return redirect('tax')->withSuccess('The tax has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = \App\Tax::findOrFail($id);
        return view('admin/tax/tax_form', [
            'tax' => $tax
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
        $tax = \App\Tax::findOrFail($id);
        $tax->name=$request->name;
        $tax->description=$request->description;
        $tax->save();
        return redirect('tax')->withSuccess('The tax has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $tax = \App\Tax::findOrFail($id);
                $lots=$tax->lots()->get();
                foreach ($lots as $lot) {
                    $lot->delete();
                }
                $tax->delete();
            }); 
            return redirect('tax')->withSuccess('The tax and related lots have been deleted');
        } catch (Exception $e){
            return redirect()->back()->withDanger('Woops, something went wrong! Please try again latter.');
        }
        
        
    }
}
