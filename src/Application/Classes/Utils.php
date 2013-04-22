<?php
namespace Application\Classes;

class Utils
{
    public static function dotdotdot($string, $length)
    {
        if (strlen($string) > $length)
            $string = substr($string, 0, $length - 3)."...";

        return $string;
    }

    /**
    * Formats the date for a standard forum time. Takes care of timezones
    *
    * @param string $date A date string in any format
    * @param boolean $short    True if you want the short format
    * @return string A formatted string depending on how far away $date is from now.
    */
    public static function formatDate($date)
    {
        // make an extra variable we will override
        $date = strtotime($date);
        $extra = "";

        // Most of this code found on php's date() page by davet15@hotmail.com on 08-Mar-2009 04:13
        $time = time();

        // The difference (integer representing seconds)
        $diff = $time - $date;

        if($diff < 60)
        {
            return "just now";
        }
        else if($diff < 60 * 60) // less than an hour ago
        {
            // 2:01am (13 minutes ago)
            // how many minutes ago
            $result = floor($diff/60);
            $plural = self::plural($result);

            // The time ago if we don't want the short version
            return $result." minute".$plural." ago";
        }
        else if($diff < 60 * 60 * 24) // less than 24 hours ago
        {
            //7:28pm (7 hours ago)

            $result = floor($diff/(60*60));
            $plural = self::plural($result);

            return $result." hour".$plural." ago";
        }
        else if($diff < 60 * 60 * 24 * 30)
        {
            $result = floor($diff/(60*60*24));
            $plural = self::plural($result);

            return $result." day".$plural." ago";
        }
        // else
        $result = floor($diff/(60*60*24*30));
        $plural = self::plural($result);

        return $result." month".$plural." ago";
    }

    /**
    * Helps generate singular strings/plural strings
    *
    * @param integer $num the number to evaluate
    * @return string "s" if $num is > 1, "" otherwise
    */
    public static function plural($num, $endsInY = false)
    {
        if ($num != 1)
        {
            if ($endsInY)
                return "ies";
            else
                return "s";
        }
        else
        {
            if ($endsInY)
                return "y";
            else
                return "";
        }
    }
}