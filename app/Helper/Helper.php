<?php

namespace App\Helper;
use Illuminate\Support\Str;

class Helper
{
    public static function filterText($text, $deep = false, $tags = '') {
        $tags = Str::finish($tags, '|') . 'code|b|i|u|p|ul|ol|li|pre|h1|h2|h3|h4|h5|h6|br|hr';
        if($deep) {
            return strip_tags($text);
        }
        $text = preg_replace("/<({$tags}) [^>]*>/", "<$1>", $text);
        return strip_tags(self::closetags($text), explode('|', $tags));
    }
    public static function closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    } 
    public static function shortNum($num) {
        $num = (int) $num;
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
        return 'now';
    }
    public static function outputText($text) {
        // Replace Links with http://
        $text = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\" rel=\"nofollow\">\\2</a>", $text);
        
        // Replace Links without http://
        $text = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\" rel=\"nofollow\">\\2</a>", $text);
    
        // Replace Email Addresses
        $text = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $text);

        $text = preg_replace("/\n{1,}/", "<br>", $text);

        return $text;
    }
}
