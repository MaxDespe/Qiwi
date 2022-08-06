<?php

namespace Qiwi\Methods;
use Qiwi\Objects\RequestHistory;
use Qiwi\Objects\ResponseHistory;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;


/**     
*    Информация о транзакции
*
*   Запрос используется для получения информации по определенной транзакции из вашей истории платежей.
*
*        transactionId - номер транзакции из истории платежей (параметр data[].txnId в ответе)
*        type - тип транзакции из истории платежей (параметр data[].type в ответе). Параметр является необязательным

extends RequestEntity
**/

class PaymentInfo extends RequestEntity
{
    
    /** @var string Request uri */
    public $uri = "payment-history/v2/transactions/{transaction_id}";

    /**
     * @inheritDoc
     */
    public function prepareUri($baseURI, $transaction_id)
    {
        return str_replace('{transaction_id}',$transaction_id, $baseURI.$this->uri);
    }
    
     /**
     * Prepare resource method
     * 
     * @return string
     */
    public function prepareMethod()
    {
        return "GET";
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
        $_POST['TransactionInfo'];
        self::InputDataForms();
        
        if(is_array($args) === false){
           echo "<br />";   echo "Qiwi args не массив и являетсяс строкой со значением   :"; echo "<br />";  echo $args;echo "<br />"; 
           $this->getDataOut($args);
        }
        
        if(is_array($args)=== true){
            echo "<br />";   echo "Qiwi args является массивом со значением   "; echo "<br />";  var_dump($args);echo "<br />"; 
            if($args['transaction_id']){
               $this->getDataOut($args['transaction_id']);
            }
        }  
        return parent::exec($this->txnId['transaction_id'], $token, $baseURI, $name, $params, $proxy, $http_client);
    }
    
    
    public function getDataOut($data = false)
	{
        if(isset($_POST['TransactionInfo']))
		{
            if(isset($_POST['transactionid'])){
                $this->transaction_id = $_POST['transactionid'];
            }else{
                throw new InvalidArgumentsException('Отсутствует идентификатор транзакции');
            }

            $txnId  = [
                'transaction_id' => $this->transaction_id
            ];  

            var_dump($txnId );
			return $this->txnId  = $txnId ;
			
		}
      
        if (isset($data)){        
            
            $this->transaction_id = (string)$data;
            
            $txnId  = [
            'transaction_id' => $this->transaction_id
            ];
            
            var_dump($txnId );
            return $this->txnId  = $txnId ; 
        }
       
    }
    
    
    /**
	*
    */
	static public function InputDataForms() 
	{
		?>
		<form role="form" name="TransactionInfo" method="POST" action=" "> 
		<div class="form"><label for="start">Введите номер транзакции в QIWI</label>
		<div class="field2"><label for="transactionid"></label><input type="text" id="transactionid" name="transactionid"></div>
		<div class="field"><input type="submit" name="TransactionInfo" value="Получить информацию"></div>
		</div>
		</form>
		<?php
	}
    
    
    
}
?>