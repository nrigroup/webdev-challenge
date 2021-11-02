<?php
namespace App;

use Illuminate\Support\Facades\Log;

trait Utils {
  function print_to_log($filename, $function, $line_number, $info) {
    Log::info("$filename::$function::$line_number::$info");
  }

  function print_to_error($filename, $function, $line_number, $info) {
    Log::error("$filename::$function::$line_number::$info");
  }

  function parse_csv($file, $delimiter) {
    $file_handle = fopen($file, 'r');
    while(!feof($file_handle)) {
      $line = fgetcsv($file_handle, 0, $delimiter);
      if (!empty($line)) {
        $line_of_text[] = $line;
      }      
    }
    fclose($file_handle);
    return $line_of_text;
  }

  function generate_report($array, $cate, $val, $sort_by_date=false) {
    $report = array_reduce($array, function($carry, $item) use($cate, $val) {
      if (array_key_exists($item->{$cate}, $carry)) {
        $carry[$item->{$cate}] += $item->{$val};
      } else {
        $carry[$item->{$cate}] = $item->{$val};
      }
      
      return $carry;
    }, []);

    if ($sort_by_date) {
      uksort($report, function($a, $b) {        
        return (strtotime($a) - strtotime($b));
      });
    }
    
    return $report;
  }
}