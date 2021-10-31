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
      $line_of_text[] = fgetcsv($file_handle, 0, $delimiter);
    }
    fclose($file_handle);
    return $line_of_text;
  }
}