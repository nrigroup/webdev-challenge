<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Submission;
use File;
use Carbon\Carbon;
use Session;

use App\Rules\CSVExtentionCheck;

class UploadController extends Controller
{
    public function processCSV(Request $request){


        $validator = Validator::make($request->all(), [
          'file' => ['required', 'file', new CSVExtentionCheck],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        if ($request->hasFile('file')) {

            $rows = array_map('str_getcsv', file($request->file));
            $header = array_shift($rows);
            $csv = array();


            foreach ($rows as $row){
                $csv[] = array_combine($header, $row);
            }

                foreach ($csv as $c) {

                    $submission = new Submission();
                    $submission->title     = $c['lot title'] ?? null;
                    $submission->location  = $c['lot location'] ?? null;
                    $submission->category  = $c['category'] ?? null;
                    $submission->condition = $c['lot condition'] ?? null;
                    $submission->date      = Carbon::parse($c['date'])->format('Y-m-d') ?? null;
                    $submission->tax_name  = $c['tax name'] ?? null;
                    $submission->pre_tax   = $c['pre-tax amount'] ?? null;
                    $submission->tax_amount= $c['tax amount'] ?? null;
                    $submission->total     = $submission->pre_tax + $submission->tax_amount;
                    $submission->save();

                }

        }

        Session::flash('success', 'Successfully Uploaded!');
        return back();

    }

}
