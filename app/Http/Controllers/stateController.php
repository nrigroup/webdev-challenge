<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Datetime;


class stateController extends BaseController
{
    public function index() {
		$datas = DB::select('select * from testing.data');
		return view('state',['datas'=>$datas]);
    }
}