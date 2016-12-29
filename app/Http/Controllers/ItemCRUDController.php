<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class ItemCRUDController extends Controller
{

    /* Display a listing of the resource */
    public function index(Request $request)
    {
        $auction = Item::orderBy('id','DESC')->paginate(5);
        return view('ItemCRUD.index',compact('auction'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /* Show the form for creating a new resource */
    public function create()
    {
        return view('ItemCRUD.create');
    }

    /* Store a newly created resource in database */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'category' => 'required',
            'lot_title' => 'required',
            'lot_location' => 'required',
            'lot_condition' => 'required',
            'pre_tax_amount' => 'required',
            'tax_name' => 'required',
            'tax_amount' => 'required',                       
        ]);

        Item::create($request->all());
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item created successfully');
    }

    /* Display the specified resource */
    public function show($id)
    {
        $item = Item::find($id);
        return view('ItemCRUD.show',compact('item'));
    }

    /* Show the form for editing the specified resource  */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('ItemCRUD.edit',compact('item'));
    }

    /* Update the specified resource in storage */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Item::find($id)->update($request->all());
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item updated successfully');
    }

    /* Remove the specified resource from storage */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item deleted successfully');
    }
}