<?php

namespace App;

use Illuminate\Support\Facades\Log;

trait Utils
{
  function print_to_log($filename, $function, $line_number, $info)
  {
    Log::info("$filename::$function::$line_number::$info");
  }

  function print_to_error($filename, $function, $line_number, $info)
  {
    Log::error("$filename::$function::$line_number::$info");
  }

  /**
   * Parse CSV file.
   * @param string: $file: upload filename.
   * @param string: $delimiter: default value is ","
   * @return \array 2D array of the CSV file.
   */
  function parse_csv($file, $delimiter = ",")
  {
    $file_handle = fopen($file, 'r');
    while (!feof($file_handle)) {
      $line = fgetcsv($file_handle, 0, $delimiter);
      if (!empty($line)) {
        $line_of_text[] = $line;
      }
    }
    fclose($file_handle);
    return $line_of_text;
  }

  /**
   * Generate report based on column name, date column will be format to m/d/Y, 
   * here the numeric representation of a month and a day is without leading zeros.
   * @param array: $array: data source
   * @param string: $column: class name
   * @param string: $val: the property where its value is accumulated
   * @param boolean: $sort_by_date: if true, the report will be sorted by date
   * @return \array 1D array of the report.
   */
  function generate_report($array, $column, $val, $sort_by_date = false)
  {
    $report = array_reduce($array, function ($carry, $item) use ($column, $val, $sort_by_date) {
      if ($sort_by_date) {
        $category_name = date_format(date_create(($item->{$column})), 'n/j/Y');
      } else {
        $category_name = $item->{$column};
      }

      if (array_key_exists($category_name, $carry)) {
        $carry[$category_name] += $item->{$val};
      } else {
        $carry[$category_name] = $item->{$val};
      }

      return $carry;
    }, []);

    if ($sort_by_date) {
      uksort($report, function ($a, $b) {
        return (strtotime($a) - strtotime($b));
      });
    }

    return $report;
  }
}
