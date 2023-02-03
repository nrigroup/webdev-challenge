<?php


function CreateConnection () {
    /*
     * Variable to store database
     * Connection Info
     * Server Name, User Name, Password of database
     * */
    $hostname = "localhost";
    $username = "dhir";
    $password = "password";
    $dbname = "auctiondetails";

    // Create connection
    $conn = new mysqli($hostname, $username, $password);

    // Check connection to Database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql)) {
        // database created
    } else {
        // error creating a new database
    }
    $conn = new mysqli($hostname, $username, $password, $dbname);

    return $conn;
}
