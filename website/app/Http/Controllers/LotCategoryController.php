<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class lotCategoryController extends Controller
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
        $cats = \App\LotCategory::orderBy('id', 'desc')->with('parent')->paginate();
        return view('admin/lotCategory/lotCategory_list', ['cats' => $cats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = new \App\LotCategory;
        $parents = \App\LotCategory::where('id','!=',Auth::id())->where('parent_id','!=',Auth::id())->get();
        return view('admin/lotCategory/lotCategory_form', [
            'parents' => $parents,
            'cat' => $cat
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
        $cat=new \App\LotCategory;
        $cat->name=$request->name;
        $cat->parent_id=$request->parent_id;
        
        $cat->save();
        return redirect('category')->withSuccess('The category has been added');
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
        $cat = \App\LotCategory::findOrFail($id);
        $parents = \App\LotCategory::where('id','!=',$id)->where('parent_id','!=',$id)->get();
        return view('admin/lotCategory/lotCategory_form', [
            'parents' => $parents,
            'cat' => $cat
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
        $cat = \App\LotCategory::findOrFail($id);
        $cat->name=$request->name;
        $cat->parent_id=$request->parent_id;
        $cat->save();
        return redirect('category')->withSuccess('The category has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = \App\LotCategory::findOrFail($id);
        $lots = $cat->lots()->get();
        foreach ($lots as $lot) {
            $lot->delete();
        }
        $cat->delete();

        return redirect()->back()->withSuccess('The category and related lots have been deleted!');
    }
}
