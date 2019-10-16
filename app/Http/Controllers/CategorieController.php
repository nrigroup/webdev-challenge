<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categorie;

class CategorieController extends Controller
{
	//render a list of categories
    public function index()
    {
    	$categories = \DB::table('categories')
                ->orderBy('name', 'asc')
                ->get();

    	return view('categories.index', ['categories' => $categories]);
    }

	//render a single category
    public function show($id)
    {
    	$categorie = Categorie::find($id);
    	return view('categories.show', ['categorie' => $categorie]);
    }

    //shows a view to create a new category
    public function create()
    {
    	return view('categories.create');
    }

    //persist a new category
    public function store()
    {
    	request()->validate([
    		'name' => ['required','min:3','unique:categories']
    	]);

    	$categorie = new Categorie();
    	$categorie->name = request('name');
    	$categorie->save();

		return redirect('/categories');
    }

	//shows a view to edit a category
    public function edit($id)
    {
    	$categorie = Categorie::find($id);
    	return view('categories.edit', ['categorie' => $categorie]);
    }

	//persist an edited category
    public function update($id)
    {
    	request()->validate([
    		'name' => ['required','min:3','unique:categories']
    	]);

    	$categorie = Categorie::find($id);
    	$categorie->name = request('name');
    	$categorie->save();

    	return redirect('/categories');
    }

    //remove the category (disable)
    public function destroy($id)
    {
    	$categorie = Categorie::find($id);
    	$categorie->delete();

    	return redirect('/categories');
    }

}
