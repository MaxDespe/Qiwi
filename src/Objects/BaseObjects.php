<?php  namespace Qiwi\Objects;


/**
 * Class BaseObject.
 */
abstract class BaseObjects 
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
     * Builds collection entity.
     *
     * @param array|mixed $data
     */
    public function __construct($data)
    {
         
        return $this->array2object($data);
        // $this->mapRelatives();
        // $this->result = $result;
        
    }

    /**
    * Property relations.
    *
    * @return array
    */
    //abstract public function relations();
    
    /**
    * Map property relatives to appropriate objects.
    *
    * @return array|void
    */
    public function mapRelatives()
    {
         $relations = $this->relations();

        if (empty($relations) || !is_array($relations)) {
            return false;
        }

        $results = $this->all();
        foreach ($results as $key => $data) {
            foreach ($relations as $property => $class) {
                if (!is_object($data) && isset($results[$key][$property])) {
                    $results[$key][$property] = new $class($results[$key][$property]);
                    continue;
                }

                if ($key === $property) {
                    $results[$key] = new $class($results[$key]);
                }
            }
        }

        return $this->result =  $this->array2object($results);
        /* $relations = $this->relations();
        echo "<br />";   echo "Qiwi Class relations   "; echo "<br />"; 
        echo "<pre>";
        print_r($relations); echo "</pre>";
        echo "<br />";echo "<br />"; 
        echo "<br />";
         $class = $relations::make($this->result);
         if (class_exists($class)) {
            return $class::make($value);
        }
        return $this->result; */
    }
    
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
        if(is_null($value) === true){
            if (in_array($value, [' ', 'false'], true)) {
                return $value === 'null';
            }else{
                 return $value;
            }
        }
         if(is_string($value) === true){
                if(strtotime($value)){
                return date("d:m:Y H:i:s", strtotime($value));
                }
        }
        return $value = ($value) ? $value : 'false';;
       
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
    
     /**
     * Get an item from the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     *
     * @return mixed|static
     */
    public function get($key, $default = null)
    {
        if ($this->offsetExists($key)) {
            return is_array($this->items[$key]) ? new static($this->items[$key]) : $this->items[$key];
        }

        return value($default);
    }

   

    /**
     * Returns raw response.
     *
     * @return array|mixed
     */
    static public function getRawResponse()
    {
        return $this->result;
    }

    /**
     * Returns raw result.
     *
     * @param $data
     *
     * @return mixed
     */
    public function getRawResult($data)
    {
        return $this->get($data, 'result', $data);
    }

    /**
     * Get Status of request.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return get($this->items, 'ok', false);
    }
}
