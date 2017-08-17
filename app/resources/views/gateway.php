<?php
$mike = "dont fuck with mike";
$user_name = "root";
$password = "";
$database = "styleminions";
$server = "127.0.0.1"; 
$sql = "SELECT * FROM brands where b_id = 20";

$link = mysqli_connect($server, $user_name, $password, $database);
$run = mysqli_query($link, $sql);
$result = mysqli_fetch_array($run);