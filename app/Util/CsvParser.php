<?php

namespace App\Util;

use Illuminate\Http\UploadedFile;
use League\Csv\Reader;

class CsvParser
{

    private static $required_headers = [
        'date',
        'category',
        'lot title',
        'lot location',
        'lot condition',
        'pre-tax amount',
        'tax name',
        'tax amount'
    ];

    /**
     * @param UploadedFile $file
     * @return string
     */
    public static function toString(UploadedFile $file)
    {
        return Reader::createFromPath($file, 'r')->setHeaderOffset(0)->getContent();
    }

    /**
     * @param UploadedFile $file
     * @return array
     */
    public static function toArray(UploadedFile $file)
    {
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        return $csv;
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function hasValidHeaders(array $array)
    {
        return $array == self::$required_headers;
    }



}