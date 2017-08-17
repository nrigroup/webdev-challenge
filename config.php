<?php
function getdb(){
$servername = "localhost";
$username = "shiva";
$password = "shiva123";
$db = "NRIChallenge";

try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>