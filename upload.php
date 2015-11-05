<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    </head>
<body>
    
<div class="container-fluid">
  <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
<?php
set_time_limit(0);
include("site.inc.php");
include_once("functions.inc.php");

/* Connect to MySql database */
$con=mysqli_connect("localhost",$username,$password,$database);
if (mysqli_connect_errno()) print "Failed to connect to MySQL: " . mysqli_connect_error();

/* Check if the CSV was uploaded correctly */

if ( isset($_POST["submit"]) ) {
   if ( isset($_FILES["uploadfile"])) {
   if ($_FILES["uploadfile"]["error"] > 0) {
            print "<div class='alert alert-danger' role='alert'>Couldn't upload the CSV file. Return Code: " . $_FILES["uploadfile"]["error"] . "</div><br />";

        }else{    
   $mimesType = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
   if(!in_array($_FILES["uploadfile"]["type"],$mimesType)){
       die("Sorry, this mime type $mimesType not allowed");
   }

$full_url_path=dirname(__FILE__)."/";
$target_dir = $full_url_path."uploads/";
$target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);

/* Check that the file with same name doesn't already exist */
if (file_exists("uploads/" . $_FILES["uploadfile"]["name"])) {
            print $_FILES["uploadfile"]["name"] . " already exists. Please try again.";
             }
             else {
            $storagename = "uploaded_file_".rand(1,100000).".csv";
            move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "uploads/" . $storagename);
            print "<div class='alert alert-success' role='alert'>Saved in: " . "uploads/" . $_FILES["uploadfile"]["name"] . "</div><br />";
            }

/* Parse and read the entire CSV file into an array */            
$csv = csv_to_array("uploads/".$storagename,',');

/*
foreach($csv as $cid=>$cval){
 print   "<b>$cid</b><br />";
 print_r($cval); print "<br /><br />"; 
}
*/

?>
<p style='display:none;'>
<?php
/* Loop through the array with CSV entries */
foreach($csv as $id=>$line){
$auction_date=trim($line["date"]);
$category=trim($line["category"]);
$lot_title=trim($line["lot title"]);
$lot_location=trim($line["lot location"]);
$lot_condition=trim($line["lot condition"]);
$pre_tax_amount=trim($line["pre-tax amount"]);
$tax_name=trim($line["tax name"]);
$tax_amount=trim($line["tax amount"]);
//print "$auction_date, $category, $lot_title, $lot_location, $lot_condition, $pre_tax_amount, $tax_name, $tax_amount<br />";
if(!mysqli_query($con,"insert into $category_tbl (category) values ('$category')")) print "<br />Error 1: ".mysqli_error($con);
if(!mysqli_query($con,"insert into $lot_condition_tbl (lot_condition) values ('$lot_condition')")) print "<br />Error 2: ".mysqli_error($con);
if(!mysqli_query($con,"insert into $lot_location_tbl (lot_location) values ('$lot_location')"))  print "<br />Error 3: ".mysqli_error($con);
if(!mysqli_query($con,"insert into $tax_name_tbl (tax_name) values ('$tax_name')")) print "<br />Error 4: ".mysqli_error($con);

$item_qr="insert into items (auction_date,category,lot_title,lot_location,lot_condition,pre_tax_amount,tax_name,tax_amount) values 
('$auction_date',
'".getRowID($con,$category_tbl,"category",$category)."',
'$lot_title',
'".getRowID($con,$lot_location_tbl,"lot_location",$lot_location)."',
'".getRowID($con,$lot_condition_tbl,"lot_condition",$lot_condition)."',
'$pre_tax_amount',
'".getRowID($con,$tax_name_tbl,"tax_name",$tax_name)."',
'$tax_amount')";
mysqli_query($con,$item_qr);
//print "$item_qr<br />";
}
?>
</p>
<?php
/* Print reports */
$report_result=mysqli_query($con,"select auction_date,category,pre_tax_amount,tax_amount from items");
while($report_row=mysqli_fetch_array($report_result,MYSQLI_ASSOC)){
    list($month,$day,$year)=explode("/",$report_row['auction_date']);
    $monthly_expenditure[$month."/".$year]=$monthly_expenditure[$month."/".$year]+$report_row['pre_tax_amount']+$report_row['tax_amount'];
    $category_expenditure[$report_row['category']]=$category_expenditure[$report_row['category']]+$report_row['pre_tax_amount']+$report_row['tax_amount'];
}
?>
<br /><br /><h3>Month / Year-wise expenditure</h3>
<table class='table'>
    <tr><th>Month / Year</th><th>Expenditure ($)</th></tr>
    <?php
foreach($monthly_expenditure as $month_year=>$expenditure){
           print "<tr><td>$month_year</td><td>$expenditure</td></tr>";       
   }
?>
</table>

<br /><br /><h3>Category-wise expenditure</h3>
<table class='table'>
    <tr><th>Category</th><th>Expenditure ($)</th></tr>
<?php
foreach($category_expenditure as $category=>$expenditure){
           print "<tr><td>".getRowValue($con,$category_tbl,"category",$category)."</td><td>$expenditure</td></tr>";       
   }
?>
</table>
<?php

}
}
}

mysqli_close($con);

/* Get id of the specified column value of the specified table */
function getRowID($con,$table,$coulmn,$value){
$result=mysqli_query($con,"select ".$coulmn."_id from $table where $coulmn='$value'"); //print "select ".$coulmn."_id from $table where $coulmn='$value'<br />";
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
return $row[$coulmn.'_id'];
}

/* Get value of the specified column id of the specified table */
function getRowValue($con,$table,$coulmn,$value){
$result=mysqli_query($con,"select ".$coulmn." from $table where ".$coulmn."_id='$value'"); //print "select ".$coulmn."_id from $table where $coulmn='$value'<br />";
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
return $row[$coulmn];
}

?> 
</div>
     <div class="col-md-3"></div>
</div>
</div>

</body>
</html> 
