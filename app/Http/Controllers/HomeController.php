<?php 

namespace App\Http\Controllers;

class HomeController extends Controller
{
	/**
	*Loads the default laravel's welcome page
	*/
	public function index()
	{
		$pageType = "index";

		return view('welcome', compact('pageType'));
	}
}