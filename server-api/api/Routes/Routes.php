<?php

// Importing the router classes
require_once "AuctionItemData.php";

$auctionItemData = new AuctionItemData();
// Getting current URI
$uri = $_SERVER["REQUEST_URI"];

/*
 * Creating data variable for
 * response of api server
 * */
$result = array("status" => 0, "log" => "Something went wrong");


// Api Routes
if ($uri === "/") {
    /*
     * TO check connection to server
     *
     * returns json
     * with status TRUE
     * */
    $result["status"] = 1;
    $result["log"] = "connected";

    // sending json as reply
    echo json_encode($result);

} else if ($uri === "/getData") {
    // Getting response from auctionItemData GET method
    // and sending it out

    // sending json data
    echo $auctionItemData->Get();

} else if (preg_match('/^\/uploadData\?/', $uri)) {
    /*
     * Using regex to match uri
     * */

    // Getting response from auctionItemData UPLOAD method
    // and sending it out
    $response = $auctionItemData->Upload();

    if ($response) {
        $result["status"] = 1;
        $result["log"] = "uploaded";
    }
    // converting result to json
    echo json_encode($result);
} else {
    /*
     * if path not match
     *
     * returns json
     * with status False
     * and log path not found
     * */
    $result["status"] = 0;
    $result["log"] = "path not found";

    // sending json as reply
    echo json_encode($result);
    echo $uri;
}
