<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UploadCsv extends Controller
{
    public function collect(Request $request){
        
        $uploadtime = date("Y-m-d H:i:s");//Timestamp http request to retrieve only the data we need
        //DB info here 
        $user_name = "root";
        $password = "";
        $database = "styleminions";
        $server = "127.0.0.1"; 

        function readCSV($csvFile){
            //Read and Parse CSVfile
            $file_handle = fopen($csvFile, 'r');
            while (!feof($file_handle) ) {
                $line_of_text[] = fgetcsv($file_handle, 10240);
            }
            fclose($file_handle);
            return $line_of_text;
        }
        
        if($request->file('ex') != null){
            //CSV File is already validated on the front-end but could still be vakidated on the back-end.
            //No need to store the CSV file on the server. We only need the data inside it.
            $file = $request->file('ex');
            $f_name = $file->getClientOriginalName();
            $tmpName = $_FILES['ex']['tmp_name'];
            $arr = readCSV($tmpName);

            //prepare for Mysql with query and preventing sql injection
            $sql_insert ='';
            $z = 0;
            $link = mysqli_connect($server, $user_name, $password, $database);
            foreach($arr as $arr){
                if ($z != 0){
                    for($i=1; $i<8; $i++){//assuming the order of the columns is always consistent

                           $arr[$i] = mysqli_real_escape_string($link,$arr[$i]);                  
                    }
                    $arr[0]= date('Y-m-d',strtotime($arr[0]));//Always format time to make life easy for quering MYSQL
                    $sql_insert .= "INSERT INTO sales (date, category, title, location, p_condition, pre_tax_amount,
                    tax_name,tax_amount, upload_time) VALUES
                    ('{$arr[0]}','{$arr[1]}','{$arr[2]}','{$arr[3]}','{$arr[4]}','{$arr[5]}','{$arr[6]}','{$arr[7]}',
                    '$uploadtime');";
                }
             $z++;
            }


            $run = mysqli_multi_query($link, $sql_insert);
            if($run === true){
                time_nanosleep(2, 100000); //Necessary to get complete inserted data back
               
                //Callback recent data from MYSQL using time of upload
                $sql_read = "SELECT DATE_FORMAT(date,'%b-%Y') as time,category, SUM(pre_tax_amount) as total_sales FROM
                sales WHERE upload_time='$uploadtime' GROUP BY DATE_FORMAT(date,'%Y-%m'),category";

               $link = mysqli_connect($server, $user_name, $password, $database);
                $call = mysqli_query($link, $sql_read);
                //$fetch = mysqli_fetch_array($call);
                $row_cnt = mysqli_num_rows($call);

                while ($fetch = mysqli_fetch_assoc($call)){
                   $output[] = $fetch;
                }

                print_r(json_encode($output));

            }
      
        
        } else{
            echo "Why you do this? No CSV file :(";
          }
    }
    
}
