<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nri{
    /**
     * prepared_db_date, this function formats the dates 
     * into standard date format that can is valid with mysql
     *
     * @param $date string mm/dd/yyyy
     * @return string yyyy-mm-dd
     */
    public function prepared_db_date($date){
        $date_parts = explode('/', $date);
        $year = $date_parts[2];
        $month = sprintf('%02d', intval($date_parts[0]));
        $day = sprintf('%02d', intval($date_parts[1]));
        $new_date = $year.'-'.$month.'-'.$day;
        return $new_date;
    }
    
    /**
     * sanitize_data, this function sanitizes the data 
     */
    public function sanitize_data($csv_array){
        for($i = 0; $i < count($csv_array); $i++){
            $csv_array[$i][0] = $this->prepared_db_date($csv_array[$i][0]);
            $csv_array[$i][1] = trim($csv_array[$i][1]);
            $csv_array[$i][2] = trim($csv_array[$i][2]);
            $csv_array[$i][3] = trim($csv_array[$i][3]);
            $csv_array[$i][4] = trim($csv_array[$i][4]);
            $csv_array[$i][5] = floatval($csv_array[$i][5]);
            $csv_array[$i][6] = trim($csv_array[$i][6]);
            $csv_array[$i][7] = floatval($csv_array[$i][7]);
        }
        return $csv_array;
    }
}