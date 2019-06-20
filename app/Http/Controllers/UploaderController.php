<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\AuctionData;
use League\Csv\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploaderController extends Controller
{
    public function upload(Request $request) {
        // Validate incoming file request if file is not in .csv format
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
        ]);

        // Return false when validation fails
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }
        
        // Return array of records from the csv file
        $records = $this->processFile($request->file);
        
        try {
            \DB::table('auction_data')->insert($records);

            return response()->json(['success' => true], 201);

        } catch (\Execption $e) {

            return response()->json(['success' => false, 'errors' => $e->getMessages()], 403);
        }

    }

    private function processFile($file) {
        $reader = Reader::createFromPath($file, 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        
        $results = [];

        foreach ($records as $offset => $record) {
            
            $results[] = [
                // Convert date to Y-m-d Format as we insert : 
                'date' => Carbon::createFromFormat('m/d/Y', $record['date'])->format('Y-m-d'),
                'category' => $record['category'],
                'lot_title' => $record['lot title'],
                'lot_location' => $record['lot location'],
                'lot_condition' => $record['lot condition'],
                'pre_tax_amount' => $record['pre-tax amount'],
                'tax_name' => $record['tax name'],
                'tax_amount' => $record['tax amount'],
                
                // Adding created_at and updated_at value as the DB::insert query don't add timestamp
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }   

        return $results;
    }

}
