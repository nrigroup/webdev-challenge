<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function postData(Request $request){
        // $data = $request -> validated();
        @var $Lotlog
        $lotlog = Lotlog::create([
            'date'=>$data[0][0],
            'category'=>$data[0][1]
        ]);

        return (compact('date', 'category'));
    }
}
