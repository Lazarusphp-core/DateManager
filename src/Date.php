<?php

namespace LazarusPhp\DateManager;
use DateTimeZone;
use DateTime;
use DateInterval;

class Date
{
    private static $format = [];
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
        $date2 = self::create($date2);
        $result = self::create($date1);
//        if ($result->format("d/m/y") > $date2->format("d/m/y"))
//        {
            $result = $result->diff($date2);


        $format = strtolower($format);
        $format = (object) self::explodeFormat($format);

                $output = [];
                ($result->y > 1) ? $y = "Years" : $y = "Year";
                ($result->d > 1) ? $d = "Days" : $d = "Day";
                ($result->h > 1) ? $h = "Hours" : $y = "Hour";
                ($result->i > 1) ? $i = "Minutes" : $i = "Minute";
                ($result->s > 1) ? $s = "Seconds" : $s = "Second";

//                Must be in this order to work in correct format
                if (isset($format->years)) {

                        ($format->years == true && $result->y !== 0 ) ? $output[] = "%y $y" : false;

                }

                if (isset($format->days)) {
                    ($format->days == true  && $result->d !== 0 ) ? $output[] = "%d $d" : false;
                }

                if (isset($format->hours)) {
                    ($format->hours == true  && $result->h !== 0 ) ? $output[] = "%h $h" : false;
                }

                if (isset($format->minutes)) {
                    ($format->minutes == true  && $result->i !== 0 ) ? $output[] = "%i $i" : false;
                }

                if (isset($format->seconds)) {
                    ($format->seconds == true  && $result->s !== 0 ) ? $output[] = "%s $s" : false;
                }

            echo $result->format(implode(" ", $output));
//
//        }





    }

    public static function explodeFormat($format)
    {
        $explode = explode("|",$format);
        foreach ($explode as $exploded)
        {
            self::$format[$exploded] = true;
        }
        return self::$format;
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
        return !empty(self::$timezone) ? self::$timezone : "GMT";
    }

    public static function setTimeZone(string $timezone)
    {
        self::$timezone = $timezone;
    }


}