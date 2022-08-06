<?php


namespace Qiwi\Methods;
use Qiwi\Objects\RequestHistory;
use Qiwi\Objects\ResponseHistory;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;

  
    /*
    *   Проверка ограничений исходящих платежей с QIWI Кошелька
    *   Следующий запрос проверяет, есть ли ограничение на исходящие платежи с QIWI Кошелька.
    */

/**
 * Class Nickname
 * @package QiwiApi\Builder
 */
class Restrictions  extends RequestEntity
{

   
    public $method = "GET";
    /**
     * Prepare resource URI
     * 
     * @param string $baseURI Base uri
     * @param string $wallet Qiwi wallet number
     * 
     * @return string
     */
    protected function prepareUri($baseURI, $wallet)
    {
		$uri = "person-profile/v1/persons/{wallet}/status/restrictions/";
        return $baseURI.str_replace('{wallet}', $wallet, $uri);
    }
    
     /**
     * Prepare resource method
     * 
     * @return string
     */
    protected function prepareMethod()
    {
         return $this->method;
    }
}
?>

	