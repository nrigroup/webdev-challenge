<?php

namespace App\Libraries;

class Csv {

    public function read($file_name)
    {
        $file_url = url('/').$file_name;

        $h = fopen($file_url, "r");
        $header = true;

        while (($data = fgetcsv($h, 1000, ",")) !== FALSE)  {
            if ($header) {
                $header = false;
            } else {
                if($data[0]){
                    $data[0] = $this->convertDate($data[0]).' 00:00:00';
                }
                $the_big_array[] = $data;
            }
        }
        fclose($h);

        return $the_big_array;
    }

    public function convertDate($date)
    {
        $exploded_date = explode('/', $date);

        $new_date = $exploded_date[2].'-'.$exploded_date[0].'-'.$exploded_date[1];

        return $new_date;
    }

}
