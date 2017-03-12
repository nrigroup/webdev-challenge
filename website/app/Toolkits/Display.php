<?php

namespace App\Toolkits;

use App\Models\User;

class Display
{
    public static function showDate($datetime)
    {
        $datetime = (string)$datetime;
        $ts = strtotime($datetime);
        $datets = substr($datetime, 0, 10);
        $yearts = substr($datetime, 0, 4);

        $now = time();
        $datenow = date('Y-m-d');
        $yearnow = date('Y');


        if ($now - $ts < 60) {
            $r = 'Just Now';
        } elseif ($now - $ts < 3600) {
            $r = floor(($now - $ts) / 60) . 'mins ago';
        } elseif ($now - $ts < 86400 && $datets == $datenow) {
            $r = substr($datetime, 11, 5);
        } elseif ($now - $ts < 31536000 && $yearts == $yearnow) {
            $r = substr($datetime, 5, 11);
        } else {
            $r = $datetime;
        }

        return "<span title='$datetime'>$r</span>";
    }


}
