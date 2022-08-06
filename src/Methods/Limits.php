<?php 

namespace Qiwi\Methods;


use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;

/**
 * Class Limits
  
    *   Лимиты QIWI Кошелька
    *   qw-limits/v1/persons/personId/actual-limits?parameter=value
    *   Запрос возвращает текущие уровни лимитов по операциям в вашем QIWI кошельке. 
    *   Лимиты действуют как ограничения на сумму определенных операций.
    types 	Array[String] 	Список типов операций, по которым запрашиваются лимиты. Каждый тип нумеруется элементом массива, начиная с нуля (types[0], types[1] и т.д.). 
    Допустимые типы операций:
    REFILL - максимальный допустимый остаток на счёте
    TURNOVER - оборот в месяц
    PAYMENTS_P2P - переводы на другие кошельки в месяц
    PAYMENTS_PROVIDER_INTERNATIONALS - платежи в адрес иностранных компаний в месяц
    PAYMENTS_PROVIDER_PAYOUT - Переводы на банковские счета и карты, кошельки других систем
    WITHDRAW_CASH - снятие наличных в месяц. Должен быть указан хотя бы один тип операций.

 * @package QiwiApi\Builder
 */
class Limits extends RequestEntity
{
    /** @var string Request uri */
    public $uri = "qw-limits/v1/persons/{wallet}/actual-limits";
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
        return $baseURI.str_replace('{wallet}', $wallet, $this->uri);
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
    
     /**
     * Overridden execute method
     *
     * @param array $args
     * @param mixed $wallet
     * @param string $token
     * @param string $baseURI
     * @param ClientInterface $http_client
     * @return array
     * @throws QiwiException
     */
    public function exec(
     $wallet, 
    $token, 
    $baseURI,
    $name,    
    $args = false,
    $proxy = false,    
    ClientInterface $http_client
    ){
        if(!$args){
            $args = [
                'types[0]' => 'REFILL', 
                'types[1]' => 'TURNOVER', 
                'types[2]' => 'PAYMENTS_P2P', 
                'types[3]' => 'PAYMENTS_PROVIDER_INTERNATIONALS', 
                'types[4]' => 'PAYMENTS_PROVIDER_PAYOUT', 
                'types[5]' => 'WITHDRAW_CASH', 
            ];
        }
  
        return parent::exec($wallet, $token, $baseURI,  $name, $args, $proxy, $http_client);
    }

}