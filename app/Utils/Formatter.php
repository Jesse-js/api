<?php 

class Formatter
{
    public static function getBrazilianDate(string $date): string
    {
        return date('d/m/Y', strtotime($date));
    }

    public static function getUniversalDate(string $date): string
    {
        return date('Y-m-d', strtotime($date));
    }
}