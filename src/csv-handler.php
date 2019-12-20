<?php

/** Variables */
$servername = "localhost";      // Your DB Host
$username = "root";             // Your Username
$password = "";                 // Your Password
$name = "test";                 // Your DB Name
$columns = ["date","category","lot title","lot location","lot condition","pre-tax amount","tax name","tax amount"];
$data_array = [];
$connection;
$table_name;


/** Init db */
try{
    $connection = new \PDO("mysql:host=$servername;dbname=$name; charset=utf8", $username, $password);
        // set the PDO error mode to exception
    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; 
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

/** Process data to DB */
if(isset($_FILES["uploadfile"])){

    //Get file from temp dir and collect header
    $file = fopen($_FILES["uploadfile"]["tmp_name"], 'r');
    $header = fgetcsv($file, "1000", ",");

    // Verify file header is correct
    if($header == $columns){

        //Create new table with filename
        try {
            $table_name =str_replace( ".csv", "", $_FILES["uploadfile"]["name"]);
            $sql =" DROP TABLE IF EXISTS $table_name;
                CREATE table $table_name(
                ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                date Date NOT NULL, 
                category VARCHAR( 150 ) NOT NULL, 
                lot_title VARCHAR( 150 ) NOT NULL, 
                lot_location VARCHAR( 255 ) NOT NULL,
                lot_condition VARCHAR( 255 ) NOT NULL, 
                pre_tax_amount DECIMAL( 8,2 ) NOT NULL,
                tax_name VARCHAR( 50 ) NOT NULL,
                tax_amount DECIMAL( 8,2 ) NOT NULL);" ;
            $connection->exec($sql);
        }
        catch(PDOException $e){

        }

        // Loop throw rows and insert after converting formats
        while (($data = fgetcsv($file, "1000", ",")) !== false){
            //Combine array with keys for convenience
            $insert_array = array_combine($header, $data);
            foreach ($insert_array as $k => $v){
                if($k == "date"){
                    $d = DateTime::createFromFormat("m/d/Y" , $v);
                    $insert_array[$k] = '"' . $d->format("Y-m-d") . '"';
                }else if ($k !== "pre-tax amount" && $k !== "tax amount"){
                    $insert_array[$k] = '"' . $v . '"';
                }
            }
            $sql = "INSERT INTO $table_name VALUES (NULL, " . implode(",", $insert_array) . " )";
            $connection->exec($sql);

        }

        // Aggregate summed data by category per month
        for ($i=0; $i < 12; $i++) { 
            # code...
            $sql = "SELECT category, SUM(pre_tax_amount) from data WHERE month(date) = $i+1 GROUP BY category";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if($row){
                $data_array['moncat'][$i+1] = $row;
            }

        }
        // Aggregate summed data by month
        for ($i=0; $i < 12; $i++) { 
            # code...
            $sql = "SELECT month(date), SUM(pre_tax_amount) from data WHERE month(date) = $i+1 GROUP BY month(date)";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($rows) > 0 ){
                foreach($rows as $row) {
                    $data_array['month'][$i+1] = $row['SUM(pre_tax_amount)'];
                }
            }

        }
        // Aggregate summed data by category total
            # code...
            $sql = "SELECT month(date), category, SUM(pre_tax_amount) from data GROUP BY category";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(count($rows) > 0){
                foreach ($rows as $row) {
                    $data_array['cat'][$row['category']] = $row['SUM(pre_tax_amount)'];
                }
            }
    }
}
header('Content-type: application/json');
echo json_encode( ["success" => true, "result" => $data_array] );