<?php


namespace Qiwi\Methods;

use Psr\Http\Message\ResponseInterface;
use Qiwi\Exceptions\ResponseException;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;


class TransactionCheque extends RequestEntity
{
    /** @var string Request uri */
    public $uri = "payment-history/v1/transactions/{transaction_id}/cheque/file";
   
     /**
     * @inheritDoc
     */
    public function prepareUri($baseURI, $transaction_id)
    {  
        return $baseURI.str_replace('{transaction_id}', $transaction_id, $this->uri);
       // return str_replace('{transaction_id}',$transaction_id, $baseURI.$this->uri);
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
       
        
        if(is_array($args) === false){
           echo "<br />";   echo "Qiwi args не массив и являетсяс трокой со значением   "; echo "<br />";  var_dump($args);echo "<br />"; 
            $getDataOut = $this->getDataOut($args);
        }
        
        if(is_array($args)=== true){
            echo "<br />";   echo "Qiwi args является массивом со значением   "; echo "<br />";  var_dump($args);echo "<br />"; 
            
             if($args['transaction_id']){
               $this->txnId  = [
                'transaction_id' => $args['transaction_id']
                ];
                 var_dump($this->txnId);echo "<br />"; 
               $params = [
                    'type' => $args['type'],
                    'format' => $args['format']
                ];
               $params = json_encode($params, true);
               var_dump($params);echo "<br />"; 
            }
        }  
    $response = parent::exec($this->txnId['transaction_id'], $token, $baseURI, $name, $params, $proxy, $http_client);
    return $this->parseResponse($response);
    }
    
    
    /**
     * Reloaded parser method
     *
     * @param ResponseInterface $response
     * @return mixed|void
     * @throws ResponseException
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $content_type = $response->getHeaderLine('Content-Type');
        $content_len = $response->getHeaderLine('Content-Length');

        // Если поток содержимого не читается, создайте исключение вместо возвращаемого значения null
        if (!$response->getBody()->isReadable()) {
            throw new ResponseException('Поток ответа не читается');
        }

        // read binary data
        $image_binary = $response->getBody()->read($content_len);

        return [
            'content_type' => $content_type,
            'content_length' => $content_len,
            'data' => $image_binary
        ];
    }
}

?>