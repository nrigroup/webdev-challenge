<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpload;
use App\Inventory;
use App\Parser;
use App\Upload;

class UploadsController extends Controller
{
    /**
     * Store
     *
     * Validate, Store and process uploaded CSV
     *
     * @param StoreUpload $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUpload $request)
    {
        // Unique id to store for every upload session
        $uid = uniqid();

        // Process uploaded file
        $file = (string)new Upload($request->file('csv'), $uid);

        /**
         * Invoke CSV parser and parse the file
         * return parsed items to be database table compatible
         */
        $parser = new Parser($file, $uid);
        $parsedItems = $parser->parse();

        // Batch insert into database
        if (count($parsedItems) > 0) {

            Inventory::insert($parsedItems);

            /*
             * Construct response object with unique id
             * for the session to use it on the redirect for the dashboard
             */
            $response = [
                'uid'     => $uid,
                'message' => 'Successfully parsed and inserted into database.',
            ];

            return response()->json($response, 200);
        }


        return response()->json('Unable to parse uploaded file please try again.', 500);
    }
}
