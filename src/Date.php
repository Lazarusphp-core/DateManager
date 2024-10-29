<?php

namespace LazarusPhp\DateManager;
use DateTimeZone;
use DateTime;
use DateInterval;

class Date
{
    public static $format ="y-m-d h:i:s";
    public static $exploded = [];
    private static $instance;
    private static string $timezone = "";



    public  static function boot()
    {
        if(!isset(static::$instance))
        {
            $c = get_called_class();
            static::$instance = $c;
        }

        return static::$instance;
    }

    public static function setFormat($format)
    {
        self::$format = $format;
    }
    
    private static function defaultTimeZone()
    {
        return date_default_timezone_get();
    }
    
    public static function create($date="now"):object
    {
        return new DateTime($date,self::callTimeZone());
    }


    /**
     * @param $date1
     * @param $date2
     * @return DateInterval|false
     */
    public  static function createDiff($date1,$date2,$format="days")
    {
        // Get Date two
        $date2 = self::create($date2);
        // get date one
        $result = self::create($date1);
        // Get the Difference
        $result = $result->diff($date2);

        // Format the strings to lower case
        $format = strtolower($format);

        // Explode the string into an array
        $explode = explode("|",$format);
        // Generate an empty array
        $formatted = [];

        // Loop exploded values
        foreach ($explode as $exploded)
        {
            // generate singular values into $formatted arrays
            $formatted[$exploded] = true;
        }

        // Return $formatted array into an object
        $format = (object) $formatted;

        // Count results to determine if value is singlar or plural
                $output = [];
                ($result->y > 1) ? $y = "Years" : $y = "Year";
                ($result->d > 1) ? $d = "Days" : $d = "Day";
                ($result->h > 1) ? $h = "Hours" : $y = "Hour";
                ($result->i > 1) ? $i = "Minutes" : $i = "Minute";
                ($result->s > 1) ? $s = "Seconds" : $s = "Second";

                // Must be in this order to work in correct format

                // display Years
                if (isset($format->years)) {

                        ($format->years == true && $result->y !== 0 ) ? $output[] = "%y $y" : false;

                }

                // Display days
                if (isset($format->days)) {
                    ($format->days == true  && $result->d !== 0 ) ? $output[] = "%d $d" : false;
                }
                // Display Hours
                if (isset($format->hours)) {
                    ($format->hours == true  && $result->h !== 0 ) ? $output[] = "%h $h" : false;
                }
                // Display Minutes
                if (isset($format->minutes)) {
                    ($format->minutes == true  && $result->i !== 0 ) ? $output[] = "%i $i" : false;
                }
                // Display Seconds
                if (isset($format->seconds)) {
                    ($format->seconds == true  && $result->s !== 0 ) ? $output[] = "%s $s" : false;
                }

                // imploded $format
                $imploded = implode(" ", $output);
                // Return the final Values;
            return $result->format($imploded);
        }
    /**
     * Undocumented function
     *
     * @param [type] $date
     * @param string $format defaults to y-m-d H:i:s
     * @return integer
     */
    public static function asTimeStamp($date,$format="y-m-d H:i:s"):int
    {
        return strtotime($date->format($format));
    }

    public static function withAddedTime($date,$value)
    {
        return self::create($date)->add(self::setInterval($value));
    }

    private  static function setInterval($value)
    {
        return new DateInterval($value);
    }

    private static function callTimeZone():object
    {
        return new DateTimeZone(self::getTimeZone());
    }


    public static function getTimeZone():string
    {
        return !empty(self::$timezone) ? self::$timezone : self::defaultTimeZone();
    }

    public static function setTimeZone(string $timezone)
    {
        self::$timezone = $timezone;
    }


}