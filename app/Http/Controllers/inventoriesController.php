<?php

namespace App\Http\Controllers;

use App\Inventory;

class inventoriesController extends Controller
{
    /**
     * Fetch Spending Data
     *
     * @param null $uid
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index($uid = NULL)
    {
        /*
         * Get Spending information
         * passing the unique session id
         */
        $spending = Inventory::getSpending($uid);

        // Return json object if the request is from Ajax
        if ($spending) {
            return response()->json($spending, 200);
        }

        return response()->json('Unknown request', 500);
    }
}
