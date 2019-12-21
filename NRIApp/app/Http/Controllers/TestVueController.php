<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestVueController extends Controller
{
    //data from db here

    
    public function index() {
        //get some json data

        return [
            'name' => "John Doe"
        ];
    }
}
