<?php

namespace Qiwi\Methods;
use Qiwi\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Qiwi\Exceptions\BadRequestException;
use Qiwi\Exceptions\NotFoundException;
use Qiwi\Exceptions\QiwiException;
use Qiwi\Exceptions\ResponseException;
use Qiwi\Exceptions\TransferException;
use BadMethodCallException;
use Qiwi\Objects\Codes;

/**
 * Class RequestEntity
 * @package QiwiApi\Entities
 */
abstract class RequestEntity
{

    protected $httpStatusCode;
    /**
     * Execute request
     *
     * @param array $args Request data params
     * @param mixed $wallet Qiwi wallet number
     * @param string $token Qiwi wallet token
     * @param string $baseURI Qiwi api base uri
     * @param ClientInterface $http_client Http client
     *
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
      
            $uri = $this->prepareUri($baseURI, $wallet);
            $method = $this->prepareMethod();
            $options = $this->prepareParams( $token, $args, $proxy);
            
            
            if( $method == 'GET'){
                $response = $this->get($uri, $options, $http_client);
            }
             if( $method == 'HEAD'){
                $response = $this->head($uri, $options, $http_client);
            }
             if( $method == 'POST'){
                $response = $this->post($uri, $options, $http_client);
            }
             if( $method == 'PUT'){
                $response = $this->put($uri, $options, $http_client);
            }
             if( $method == 'PATCH'){
                $response = $this->patch($uri, $options, $http_client);
            }
            if( $method == 'DELETE'){
                $response =  $this->delete($uri, $options, $http_client);
            }
            
            return  $this->__call($name, $response);
    }


   /**
    * Sends a GET request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    *
    * @throws QiwiSDKException
    *
    * @return QiwiResponse
    */
    public function get($endpoint, $params = [], $http_client)
    {
        return $this->sendRequest(
            'GET',
            $endpoint,
            $params,
            $http_client
        );
    }
    
    /**
    * Sends a HEAD request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    *
    * @throws QiwiSDKException
    *
    * @return QiwiResponse
    */
    public function head($endpoint, $params = [], $http_client)
    {
        return $this->sendRequest(
            'HEAD',
            $endpoint,
            $params,
            $http_client
        );
    }
    /**
    * Sends a POST request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    * @param bool   $fileUpload Set true if a file is being uploaded.
    *
    * @return QiwiResponse
    */
    public function post($endpoint, array $params = [], $fileUpload = false, $http_client)
    {
        if ($fileUpload) {
            $params = ['multipart' => $params];
        } else {
            $params = ['form_params' => $params];
        }

        return $this->sendRequest(
            'POST',
            $endpoint,
            $params,
            $http_client
        );
    }
    
    /**
    * Sends a PUT request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    *
    * @throws QiwiSDKException
    *
    * @return QiwiResponse
    */
    public function put($endpoint, $params = [], $http_client)
    {
        return $this->sendRequest(
            'PUT',
            $endpoint,
            $params,
            $http_client
        );
    }


    /**
    * Sends a PATCH request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    *
    * @throws QiwiSDKException
    *
    * @return QiwiResponse
    */
    public function patch($endpoint, $params = [], $http_client)
    {
        return $this->sendRequest(
            'PATCH',
            $endpoint,
            $params,
            $http_client
            );
    }


    /**
    * Sends a DELETE request to Qiwi Bot API and returns the result.
    *
    * @param string $endpoint
    * @param array  $params
    *
    * @throws QiwiSDKException
    *
    * @return QiwiResponse
    */
    public function delete($endpoint, $params = [], $http_client)
    {
        return $this->sendRequest(
            'DELETE',
            $endpoint,
            $params,
            $http_client
        );
    }


    /**
     * Send request, return response or determine error and throw correct exception
     *
     * @param string $method Request method
     * @param string $uri Request URI
     * @param array $params Request params
     * @param ClientInterface $client Http client (instance of ClientInterface)
     *
     * @return mixed Server response
     * @throws QiwiException
     */
    protected function sendRequest($method, $uri, $params, ClientInterface $client)
    {       
        try {
            $response = $client->request($method, $uri, $params);
        } catch(RequestException $e) {
            // обработать передачу или исключение ответа
            //Исключение ответа будет создано, если HTTP-клиент не обрабатывает код состояния 400+
            //как обычный ответ('http_errors' => true)
            $this->handleException($e);
        }
            $this->httpStatusCode = Codes::resultCode( $response->getStatusCode() );
            print_r($this->httpStatusCode); echo "</pre>";
     
        if ($response->getStatusCode()!= 200) {
            $this->handleHttpError($response);
        }
       return $this->parseResponse($response);
      /*  $res = $this->parseResponse($response);
        echo "<br />";   echo "Qiwi parseResponse res   "; echo "<br />"; 
        echo "<pre>";
        print_r($res); echo "</pre>";
        echo "<br />";echo "<br />";
       return $res; */ 
    }

    /**
     * Parse and return response content
     * Depends on content type
     *
     * By default - return decoded json string
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    protected function parseResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents(), true);
       
    }

    /**
     * Determine transfer or response exception type and throw correct one
     * 
     * @param RequestException $e Request exception
     * 
     * @throws QiwiException
     */
    private function handleException(RequestException $e)
    {
        $handler_context = $e->getHandlerContext();

        // for curl exception
        if(!empty($handler_context)) {
            throw new TransferException(
                "Что-то идет не так (cUrl error number {$handler_context["errno"]})",
                $e->getCode(),
                $e->getPrevious()
            );
        }

        throw new ResponseException($e->getMessage(), $e->getCode(), $e->getPrevious());
    }

    /**
     * Handle 400 and 404 response status codes
     * Qiwi API return 400 code for validation error
     * and 404 if resource not found
     *
     * @param ResponseInterface $response Qiwi response
     * @throws QiwiException
     */
    private function handleHttpError(ResponseInterface $response)
    {
        echo $this->getHttpError = Codes::resultCode( $response->getStatusCode() );
        $code =  $response->getStatusCode(); 
        $content = $response->getBody()->getContents();

    /*     if ($code == 400) {
            throw new BadRequestException($this->getHttpError, $content, $code);
        } else if ($code == 404) {
            throw new NotFoundException($this->getHttpError, $content, $code);
        } */
    }

    /**
     * Return headers array
     *
     * @param string $token Qiwi wallet token
     * 
     * @return array
     */
    protected function prepareHeaders($token)
    {
        return [
            'Accept' =>'application/json',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
            'Host' => 'edge.qiwi.com',
        ];
    }

    /**
     * Prepare params for request
     *
     * @param array $options Request params
     * @param string $token Qiwi wallet token
     *
     * @return array
     */
    protected function prepareParams($token, $args = false, $proxy = false) {
        
        if($args){
            $params["query"] = $args;
        }
        if($proxy){
            $params["proxy"] = $proxy;
        }
        $params["headers"] = $this->prepareHeaders($token);
        return $params;
    }

    /**
    * Determine object which contains called method and call it, or throw exception
    *
    * @param string $name
    * @param array $args
    * @throws BadMethodCallException
    *
    * @return mixed
    */
    public function __call($name, $response)
    {
        $namespace_prefix = "Qiwi\\Objects\\";
        
        if (array_key_exists($name, Client::methodMap)) {
            $obj_name = $namespace_prefix.Client::methodMap[$name];
              echo "<br />";   echo " Вызывается объект  метода  :  "; var_dump($obj_name);echo "<br />";
            //$object = new $obj_name();
            return new $obj_name($response);
            //return $object->exec($response);
        }

        throw new BadMethodCallException("Клиент API Qiwi: вызов неопределенного объекта {$name}()");
    }
    
    /**
     * Return the params for this request.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the params for this request.
     *
     * @param array $params
     *
     * @return QiwiRequest
     */
    public function setParams($params = []): self
    {
        $this->params = $params;

        return $this;
    }
    
    /**
     * Prepare uri
     *
     * @param string $baseURI ase uri
     * @param string $wallet qiwi wallet number
     *
     * @return string
     */
    abstract protected function prepareUri($baseURI, $wallet);
    
    /**
    * Prepare uri
    * @return string
    */
    abstract protected function prepareMethod();
}
?>