<?php

    class Utils
    {   
        public static function isProduction() {
            return (isset($_SERVER["PRODUCTION"]) && strtolower($_SERVER["PRODUCTION"]) == "true");
        }
        
        /**
        * Get a user 
        * 
        * @param mixed $user If $user is a string, looks up a user based on username, if number, looks up by id
        * @return null if no user matches, or \Application\Entities\Users otherwise
        * @throws 
        */
        public static function getUser($user) {
            $mapper = $GLOBALS["registry"]->mapper;
            $entity = '\Application\Entities\Users';

            if (is_string($user)) {
                return $mapper->first($entity, array('username' => $user));
            }
        }

        public static function dotdotdot($string, $length)
        {
            if (strlen($string) > $length)
                $string = substr($string, 0, $length - 3)."...";

            return $string;
        }

        /**
        * Santize user input to be displayed back on the screen
        * 
        * @param string $string the string to sanitize
        */
        public static function sanitize($string) {
            $string = trim($string);
            $string = stripslashes($string);
            $string = htmlentities($string, ENT_NOQUOTES, "UTF-8");

            $string = nl2br($string);
            $string = str_replace("\t",str_repeat("&nbsp;",4), $string);

            return $string;
        }

        public static function generateSalt($max = 5) {
            $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
            $i = 0;
            $salt = "";
            while ($i < $max) {
                $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
                $i++;
            }
            return $salt;
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

        /**
        * Get the ip address of the currently connected user
        */
        public static function getIp() {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                return $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        }
}