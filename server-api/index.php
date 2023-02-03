<?php

// Define the root directory for the server
$root = __DIR__;

// Start the server
$port = 9000;
$host = "0.0.0.0";
//echo "Server running at http://$host:$port\n";
//echo "Document root is $root\n";

/*
 * Adding Headers
 * */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Requested-Method, Access-Control-Requested-Headers");

// if ($_SERVER['REQUESTED_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
// }
// Importing the api router
require_once "$root/api/Routes/Routes.php";
// The server loop
$command = sprintf("php -S %s:%d -t %s", $host, $port, $root);
exec($command);