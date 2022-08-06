<?php

namespace Qiwi;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use Qiwi\Methods\RequestEntity;
use Qiwi\Methods\ProxyChecker;
use Qiwi\Methods\TransactionInfo;


/**
 * Class Client
 * @package QiwiApi
 *
 * @see https://developer.qiwi.com/ru/qiwi-wallet-personal/ for correct request parameters
 * @method RequestEntity getProfile(array $params = [])
 * @method RequestEntity getPaymentsList(array $params)
 * @method RequestEntity getPaymentsTotal(array $params)
 * @method RequestEntity getTransactionInfo(array $params)
 * @method RequestEntity getTransactionCheque(array $params)
 * @method RequestEntity getAccountsList()
 */
class Client
{
    /**
     * Qiwi wallet number
     *
     * @var mixed
     */
    protected $wallet;

    /**
     * Qiwi wallet token
     *
     * @var string
     */
    protected $token;
  /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $proxy;
    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $ValidateProxy;
    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $http_client;

    /**
     * Base URL
     */
    private $baseURI = "https://edge.qiwi.com/";

    /**
     * @var array mapped methods 'apiCall' => 'relatedClass'
     */
    const methodMap = [
        "getProfile"            		=> "Profile",
        "getIdentificationQiwi" 		=> "IdentificationQiwi",
        "getBalanceAccount"     		=> "BalanceAccount",
        "getLimits"             		=> "Limits",
        "getHistoryPayment"     		=> "HistoryPayment",
        "getPaymentsTotal"      		=> "PaymentsTotal",
        "getPaymentInfo"   				=> "PaymentInfo",
		"getTransactionCheque"  		=> "TransactionCheque",
		"sendChequeFileToMail"  		=> "ChequeFileToMail",
		"setDefaultAccount"  			=> "DefaultAccount",
		"getOferBalance"  				=> "OferBalance",
		"getKursValute"  				=> "KursValute",
		"getMyNickName"  				=> "MyNickName",
		"getSearchPhrase"  				=> "SearchPhrase",
		"getSearchMobileProvider"  		=> "SearchMobileProvider",
		"getSearchCardProvider"  		=> "SearchCardProvider",
		"sendIdentification"  			=> "sendIdentification",
		"setBalance"  					=> "setBalance",
		"sendMoneyToQiwi"  				=> "sendMoneyToQiwi",
		"sendConverted"  				=> "sendConverted",
		"sendMoneyToProviderOthers"  	=> "sendMoneyToProviderOthers",
		"sendMoneyToOther"  			=> "sendMoneyToOther",
		"sendMoneyToProvider"  			=> "sendMoneyToProvider",
		"sendMoneyToMirCard"  			=> "sendMoneyToMirCard",
		"sendMoneyToVisaCardRf"  		=> "sendMoneyToVisaCardRf",		
		"sendMoneyToMasterCardRf"  		=> "sendMoneyToMasterCardRf",
		"sendMoneyToQiwiNickname"  		=> "sendMoneyToQiwiNickname",
		"sendBillPayment"  				=> "sendBillPayment",
		"sendRejectBillPayment"  		=> "sendRejectBillPayment",
		"getCallbackUrl"  				=> "CallbackUrl",
		"getCheckHook"  				=> "CheckHook",
		"getActiveHook"  				=> "ActiveHook",
		"getCreateHook"  				=> "CreateHook",
		"getdeleteHook"  				=> "deleteHook",
		"getSecretKey"  				=> "SecretKey",
		"getRestrictions"  				=> "Restrictions",
    ];


    /**
     * Client constructor.
     *
     * @param mixed $wallet wallet number
     * @param string $token wallet token
     * @param ClientInterface $client   http client (\GuzzleHttp\Client by default)
     */
    public function __construct(
    $wallet, 
    $token, 
    $proxyes, 
    ClientInterface $client = null
    ){
        $htmlhead = $this->htmlhead();
        echo  $htmlhead;
        
        $this->wallet   = $this->escapePlus($wallet);
        $this->token    = $token;
        
        if(isset($proxyes)){

            $this->ValidateProxy =  $this->getProxyChecker($proxyes)->result;
            if ($this->ValidateProxy=='true')
            {
                $this->proxy = $this->getProxyServer($proxyes);
              
                if (!$client) {
                    $client = new \GuzzleHttp\Client(['http_errors' => false]);
                }
                $this->getMethodMapInfo();
                
                $this->http_client = $client;
            } 
            else
            {
                throw new \InvalidArgumentException(date('Y-m-d H:i:s') ."      PROXY сервер ".$proxyes['server']." QIWI кошелька ".$this->wallet." не валидный либо долго не отвечает    \n ");
            }
        }
        else
        {
            throw new \InvalidArgumentException(date('Y-m-d H:i:s') ."      Отсутствует PROXY сервер для QIWI кошелька ".$this->wallet." соединения с QIWI API     \n ");
        }
       
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
    public function __call($name, $args = false)
    {
        $namespace_prefix = "Qiwi\\Methods\\";
        if (array_key_exists($name, self::methodMap)) {
            $methods_name = $namespace_prefix.self::methodMap[$name];
            
            echo "<br />";   echo " Вызывается метод:  "; var_dump($methods_name);echo "<br />";
            
            
            $methods = new $methods_name();
          
            return $methods->exec($this->wallet, $this->token, $this->baseURI, $name,  $args, $this->proxy, $this->http_client);
		
        }

        throw new BadMethodCallException("Клиент API Qiwi: вызов неопределенного метода {$name}()");
    }

    /**
     * Escape "+" in wallet number (if exist)
     *
     * @param mixed $wallet wallet number
     *
     * @return mixed
     */
    private function escapePlus($wallet)
    {
        if(gettype($wallet) == "string") {
            return str_replace("+", "", $wallet);
        }

        return $wallet;
    }
    
    
       /**
     * Escape "+" in wallet number (if exist)
     *
     * @param mixed $wallet wallet number
     *
     * @return mixed
     */
    public function htmlhead()
    {
        return $head = '<html><head><!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="@max">
        <link rel="icon" href="https://static.qiwi.com/img/qiwi_com/favicon/favicon-16x16.png" type="image/x-icon">
        <meta name="description" content="Visa QIWI Wallet Admin Panel">
        <title>Visa QIWI Wallet Admin Panel</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </head><body>
		  <section class="content">
		<div id="contentqiwi">';    
    }
    
	
	     /**
     * Escape "+" in wallet number (if exist)
     *
     * @param mixed $wallet wallet number
     *
     * @return mixed
     */
    public function htmlfoot()
    {
        return $head = ' </div></section><!-- /.content -->
		 <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
            Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="/admin"><i class="fa fa-home" aria-hidden="true"></i>  На главную </a>.</strong> All rights reserved.
        </footer>     
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		</body> </html>';    
    }
    
    /**
    * Returns the ProxyChecker.
    *
    * @return string
    */
    public function getProxyChecker($proxyes)
    {
        return new ProxyChecker($proxyes);
    }
    
      /**
     * The default headers used with every request.
     *
     * @return array
     */
    public function getProxyServer($proxyes)
    {
        if($proxyes['type'] == 'https'){
            $proxy_types = 'http';
        }
        $proxy = $proxy_types. '://' .$proxyes['auth']. '@' .$proxyes['server'];
        return $proxy;
    }
    
    /**
    * The default headers used with every request.
    *
    * @return array
    */
    public function getMethodMapInfo()
    {
        echo "<br />";   echo "Qiwi array mapped methods 'Call' => 'relatedClassto  function __call(name method)   "; echo "<br />"; 
        echo "<pre>";
        var_dump(self::methodMap); echo "</pre>";
        echo "<br />";
        echo "==========================================";echo "<br />";echo "<br />";
    }
    
}
?>