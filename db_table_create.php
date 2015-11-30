<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'rootadmin';

// connect database as root
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(!$conn)
{
	die("Database connection failed: " . mysqli_error());
}

echo 'Database Connected successfully'."<br />";

// create database 'nrigroup'
/*
$sql = 'CREATE Database nrigroup';
$retval = mysqli_query($conn, $sql);

if(!$retval)
{
  die('Could not create database: ' . mysqli_error($conn));
}

echo "Database nrigroup created successfully"."<br />";
*/


// create table 'purchase'
$sql = "CREATE TABLE purchase( ".
   "id INT NOT NULL AUTO_INCREMENT, ".
   "date VARCHAR(30) NOT NULL, ".
   "category VARCHAR(50) NOT NULL, ".
   "lot_title VARCHAR(50) NOT NULL, ".
   "lot_location VARCHAR(100) NOT NULL, ".
   "lot_condition VARCHAR(100) NOT NULL, ".
   "pre_tax_amount VARCHAR(20) NOT NULL, ".
   "tax_name VARCHAR(50) NOT NULL, ".
   "tax_amount VARCHAR(20) NOT NULL, ".
   "PRIMARY KEY (id)); ";

// select database 
$db_select = mysqli_select_db($conn, 'nrigroup');
if(!$db_select){
	die("Database selection failed: " . mysqli_error());
}

// execute query for creating table
$retval = mysqli_query($conn, $sql);
if(!$retval)
{
  die('Could not create table: ' . mysqli_error($conn));
}
echo "Table created successfully"."<br />";

mysqli_close($conn);

?>
