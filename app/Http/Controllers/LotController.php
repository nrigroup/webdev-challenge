<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lot;

class LotController extends Controller
{
	//render a list of categories
    public function index()
    {
    	$lots = \DB::table('lots')
                ->orderBy('updated_at', 'desc')
                ->get();

    	return view('lots.index', ['lots' => $lots]);
    }

	//render a single category
    public function show($id)
    {
    	$lot = Lot::find($id);
    	return view('lots.show', ['lot' => $lot]);
    }

    //shows a view to create a new category
    public function create()
    {
    	$categories = \DB::table('categories')
                ->orderBy('name', 'asc')
                ->get();
        $conditions = \DB::table('conditions')
                ->orderBy('title', 'asc')
                ->get();
    	return view('lots.create', ['categories' => $categories, 'conditions' => $conditions]);
    }

    //persist a new category
    public function store()
    {
    	request()->validate([
    		'title' => ['required','min:3']
    	]);

    	$lot = new Lot();
    	$lot->title = request('title');
    	$lot->location = request('location');
    	$lot->condition = request('condition');
    	$lot->categorie = request('categorie');
    	$lot->save();

		return redirect('/lots');
    }

	//shows a view to edit a category
    public function edit($id)
    {
    	$lot = Lot::find($id);
    	$categories = \DB::table('categories')
                ->orderBy('name', 'asc')
                ->get();
        $conditions = \DB::table('conditions')
                ->orderBy('title', 'asc')
                ->get();
    	return view('lots.edit', ['lot' => $lot, 'categories' => $categories, 'conditions' => $conditions]);
    }

	//persist an edited category
    public function update($id)
    {
    	request()->validate([
    		'title' => ['required','min:3']
    	]);

    	$lot = Lot::find($id);
    	$lot->title = request('title');
    	$lot->location = request('location');
    	$lot->condition = request('condition');
    	$lot->categorie = request('categorie');
    	$lot->save();

    	return redirect('/lots');
    }

    //remove the category (disable)
    public function destroy($id)
    {
    	$lot = Lot::find($id);
    	$lot->delete();

    	return redirect('/lots');
    }

}
