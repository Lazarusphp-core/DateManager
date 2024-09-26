<?php
namespace LazarusPhp\DateManager;
use DateTimeZone;
use DateTime;

class Date
{
    public  static  array $timezone = [];
    private static string $default;
    private  static  $date = [];
//    public  static function setTimeZone(string $name,string $value,bool $default = false)
//    {
//        if(self::$default == true)
//        {
//            self::$default = $value;
//        }
//        self::$timezone[$name] = $value;
//
//    }

    public static function Factory(string $name, string $format, string $timezone)
    {
        self::$date[$name] = new DateTime($format,new DateTimeZone($timezone));
        return new self;
    }

    public function output($format)
    {
        $uid = uniqid("format_");
        self::$date[$uid] .= format($format);
        return $this;
    }

    public  function __toString()
    {

    }



}