<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * shows the upload page aka the home page
     * @return view the home page
     */
    public function show()
    {
        return view('pages.home');
    }
    
    /**
     * stores the csv file then redirects to show inventory
     * @param  request $request the incoming request
     * @return view           redirects to inventory page
     */
    public function store(request $request)
    {
    	if($request->hasFile('csvfile')) {
    		$file = $request->file('csvfile');
    	}
        return redirect('/inventory');
    }
}
