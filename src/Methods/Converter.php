<?php


namespace Qiwi\Methods;


/**
 * Class Converter
 * @package QiwiTopUp
 */
class Converter
{
    /**
     * Currency by
     * @var array
     */
    private static $currencyISO = [
        'LVL' => 428,
        'RUB' => 643,
        'EUR' => 978,
        'USD' => 840,
    ];


    /**
     * @param mixed $source
     * @param bool  $camelCase
     * @return object
     */
    public static function array2object($source, $camelCase = true)
    {
        if (! is_object($source) && ! is_array($source)) {
            return $source;
        }
        $output = [];
        foreach ((array) $source as $key => $value) {
            $key = $camelCase ? self::camelCase($key) : $key;
            $output[$key] = self::array2object(self::detectBoolean($value), $camelCase); 
        }
        return (object) $output;
    }

    /**
     * @param string $string
     * @return string
     */
    public static function camelCase($string)
    {
        return preg_replace_callback('/((-|_)\w)/', function ($matches) {
            return ucfirst(trim($matches[1], '-_'));
        }, $string);
    }

    /**
     * @param string $value
     * @return string|bool
     */
    public static function detectBoolean($value)
    {
        if(is_bool($value) === true){
            if (in_array($value, ['true', 'false'], true)) {
                return $value === 'true';
            }else{
                 return 'false';
            }
        }
        return $value;
       
    }

    /**
     * Convert ISO 4217 numbers to string
     * @param string|int $currency
     * @return int|string
     */
    public static function currency($currency)
    {
        if (! is_numeric($currency)) {
            $currency = strtoupper($currency);
            return isset(self::$currencyISO[$currency]) ? self::$currencyISO[$currency] : $currency;
        }
        $foundKey = array_search($currency, self::$currencyISO);
        return $foundKey ?: $currency;
    }
}