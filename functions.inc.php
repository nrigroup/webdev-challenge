<?php

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    $count=0;
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        { 
            if($count==0)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
            $count++;
            //print_r($data);
        }
        fclose($handle);
    }
    return $data;
}

?>