<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FileserverController extends Controller
{
    public function storeFile (Request $request)
    {
        if ($request->hasFile('fileinput') && $request->file('fileinput')->isValid()) {
                $filename = uniqid().'_'.$request->file('fileinput')->getClientOriginalName();

                $path = $request->file('fileinput')->storeAs(
                    'public/storage', $filename
                );
            return [
                'msg'       => 'ok',
                'status'    => '200',
                'filename'  => $filename
            ];
        }
        else{
            return [
                'msg'       => 'Error: invalid file',
                'status'    => '400'
            ];
        }




    }
}
