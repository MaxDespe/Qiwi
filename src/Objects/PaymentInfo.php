<?php namespace Qiwi\Objects;


use Qiwi\Methods\RequestEntity;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;

/*     
Информация о транзакции

Запрос используется для получения информации по определенной транзакции из вашей истории платежей.

transactionId - номер транзакции из истории платежей (параметр data[].txnId в ответе)
type - тип транзакции из истории платежей (параметр data[].type в ответе). Параметр является необязательным

 * Class TransactionInfo
 * @package 
 */
class PaymentInfo extends BaseObjects
{
    public function __construct($response)
	{
       $TransactionInfo = parent::__construct($response);
       return $this->TransactionInfo = $TransactionInfo;
		
	}
}
?>
    
    


