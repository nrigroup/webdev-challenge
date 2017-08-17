<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Excel;

/*
 *
 * Uploading Excel file using Uploadfile() and giving the file a temp. name
 * Pretty sandard approach.
 *
 */

class NRI extends Controller
{


    public function UploadFile(){



            $file = Input::file('file');
            $destination = 'data/files/';
            $extension = $file->getclientoriginalextension();
            $filename = str_random(12).".{$extension}";
            $upload_success = $file->move($destination, $filename);

             return redirect('/check?file='.$filename);

    }


}
