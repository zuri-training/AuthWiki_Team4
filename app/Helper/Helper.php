<?php

namespace App\Helper;
use Illuminate\Support\Str;

class Helper
{
    public static function filterText($text, $deep = false, $tags = '') {
        $tags = Str::finish($tags, '|') . 'a|b|i|u|ul|ol|li|code|pre';
        if($deep) {
            return strip_tags($text);
        }
        return preg_replace(
            "/<({$tags}) [^>]*>/", "<$1>",
            strip_tags(
                $text,
                explode('|', $tags)
            )
        );
    }
    public static function shortNum($num) {
        $i = count(explode(',', number_format($num)))-1;
        $keys = ['', 'K', 'M', 'B', 'T'];
        $divs = [1, 1000, 1000000, 1000000000, 1000000000000];
        return $num > 999 ? (bcdiv($num, $divs[$i], 1).$keys[$i]) : $num;
    }
    public static function timeAgo($timeString) {
        $time = strtotime($timeString);

        $seconds = [
            60 * 60 * 24 * 365,
            60 * 60 * 24 * 30,
            60 * 60 * 24 * 7,
            60 * 60 * 24,
            60 * 60 ,
            60,
            1
        ];
        $strings = ['year', 'month', 'week', 'day', 'hour', 'min', 'sec'];
        $diff = time() - $time;

        for($i = 0; $i < count($seconds); $i++) {
            if (($calc = floor($diff / $seconds[$i])) > 0) {
                return $calc .' '. Str::plural($strings[$i], $calc) . ' ago';
            }
        }
        return 'just now';
    }
}
