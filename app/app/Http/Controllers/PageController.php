<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use DB;

class PageController extends Controller
{
    public function uploadIndex(){
        return view('upload');
    }

    public function statsIndex(){
        $data = array(
            'subs' => Submission::all(),
            'monthly' => $this->monthly()
        );
        return view('stats', $data);
    }

    public function monthly(){
        return Submission::select(DB::RAW('sum(total) as total, MONTH(date) as date_month, YEAR(date) as date_year'))
                                ->groupBy('date_year', 'date_month')
                                ->limit(3)
                                ->get();
    }
}
