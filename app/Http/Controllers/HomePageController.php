<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
	/**
	* Index function returns the index page for '/' route
	*/
    public function index()
    {
    	return view('content');
    }
}
