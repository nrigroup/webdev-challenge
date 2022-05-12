<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

use App\Models\Upload;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('upload');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validating file
        $request->validate([
            'file.*' => 'mimes:csv,txt',
        ]);

        $file = $request->file('file');

        $data = $this->csvToArray($file, ',');

        // Savung file data to the database
        for ($i=0; $i < count($data); $i++) {
            Dashboard::firstOrCreate($data[$i]);
        }

        return redirect()->route('home');
    }

    /**
     * Change csv to Array.
     *
     * @param  $filename
     * @param  $delimiter
     * @return \Illuminate\Http\Response
     */
    public function csvToArray($filename = '', $delimiter = '')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header){
                    $header = $row;
                }
                else{
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}
