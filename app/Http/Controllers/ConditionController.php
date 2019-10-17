<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Condition;


class ConditionController extends Controller
{
	//render a list of conditions
    public function index()
    {
    	$conditions = \DB::table('conditions')
                ->orderBy('title', 'asc')
                ->get();

    	return view('conditions.index', ['conditions' => $conditions]);
    }

	//render a single condition
    public function show($id)
    {
    	$condition = Condition::find($id);
    	return view('conditions.show', ['condition' => $condition]);
    }

    //shows a view to create a new condition
    public function create()
    {
    	return view('conditions.create');
    }

    //persist a new condition
    public function store()
    {
    	request()->validate([
    		'title' => ['required','min:3','unique:conditions']
    	]);

    	$condition = new Condition();
    	$condition->title = request('title');
    	$condition->save();

		return redirect('/conditions');
    }

	//shows a view to edit a condition
    public function edit($id)
    {
    	$condition = Condition::find($id);
    	return view('conditions.edit', ['condition' => $condition]);
    }

	//persist an edited condition
    public function update($id)
    {
    	request()->validate([
    		'title' => ['required','min:3','unique:conditions']
    	]);

    	$condition = Condition::find($id);
    	$condition->title = request('title');
    	$condition->save();

    	return redirect('/conditions');
    }

    //delete a condition
    public function destroy($id)
    {
    	$condition = Condition::find($id);
    	$condition->delete();
        return redirect('/conditions');
    }
}