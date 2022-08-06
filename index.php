<?php 

set_error_handler('err_handler');
function err_handler($errno, $errmsg, $filename, $linenum) {
$date = date('Y-m-d H:i:s (T)');
$f = fopen('errors.txt', 'a');
if (!empty($f)) {
$filename  =str_replace($_SERVER['DOCUMENT_ROOT'],'',$filename);
$err  = "$errmsg = $filename = $linenum\r\n";
fwrite($f, $err);
fclose($f);
}
}
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require __DIR__ . '/vendor/autoload.php';

use Qiwi\Client;


    
     $proxy_server = '';
     
       
        $proxy_auth = '';
        $proxy_type = ''; 
        $proxyesarr = array(
            'server' => $proxy_server,
            'auth' => $proxy_auth,
            'type' => $proxy_type, 
        );
       
            $qiwi_token = '';
           
            $iAccount = ''; 

  $ClientApi = new Client($iAccount, $qwtoken, $proxyesarr);

 

    $getProfile            		    = 'getProfile';            		
    $getIdentificationQiwi 		    = 'getIdentificationQiwi'; 		
    $getBalanceAccount     		    = 'getBalanceAccount';     		
    $getLimits             		    = 'getLimits';             		
    $getHistoryPayment     		    = 'getHistoryPayment';     		
    $getPaymentsTotal      		    = 'getPaymentsTotal';      		
    $getPaymentInfo   			    = 'getPaymentInfo';   				
	$getTransactionCheque  			= 'getTransactionCheque';  		
	$sendChequeFileToMail  			= 'sendChequeFileToMail';  		
	$setDefaultAccount  			= 'setDefaultAccount';  			
	$getOferBalance 				= 'getOferBalance';  				
	$getKursValute 					= 'getKursValute';  				
	$getMyNickName 					= 'getMyNickName';  				
	$getSearchPhrase  				= 'getSearchPhrase';  				
	$getSearchMobileProvider  		= 'getSearchMobileProvider';  		
	$getSearchCardProvider  		= 'getSearchCardProvider';  		
	$sendIdentification  			= 'sendIdentification';  			
	$setBalance						= 'setBalance';  					
	$sendMoneyToQiwi  				= 'sendMoneyToQiwi';  				
	$sendConverted 					= 'sendConverted';  				
	$sendMoneyToProviderOthers  	= 'sendMoneyToProviderOthers';  	
	$sendMoneyToOther  				= 'sendMoneyToOther';  			
	$sendMoneyToProvider  			= 'sendMoneyToProvider';  			
	$sendMoneyToMirCard  			= 'sendMoneyToMirCard';  			
	$sendMoneyToVisaCardRf  		= 'sendMoneyToVisaCardRf';  		
	$sendMoneyToMasterCardRf  		= 'sendMoneyToMasterCardRf';  		
	$sendMoneyToQiwiNickname  		= 'sendMoneyToQiwiNickname';  		
	$sendBillPayment  				= 'sendBillPayment';  				
	$sendRejectBillPayment  		= 'sendRejectBillPayment';  		
	$getCallbackUrl  				= 'getCallbackUrl';  				
	$getCheckHook  					= 'getCheckHook';  				
	$getActiveHook  				= 'getActiveHook';  				
	$getCreateHook  				= 'getCreateHook';  				
	$getdeleteHook  				= 'getdeleteHook';  				
	$getSecretKey  					= 'getSecretKey';  				
	$getRestrictions  				= 'getRestrictions';  				














		
      $Profile = $ClientApi->__call($getProfile);
 echo "<br />";   echo "Qiwi Class getProfile   "; echo "<br />"; 
        echo "<pre>";
        print_r($Profile); echo "</pre>";
        echo "<br />";echo "<br />";  
      
     
    $BalanceAccount = $ClientApi->__call($getBalanceAccount);
 echo "<br />";   echo "Qiwi Class getBalanceAccount   "; echo "<br />"; 
        echo "<pre>";
        print_r($BalanceAccount); echo "</pre>";
        echo "<br />";echo "<br />";  
        echo "BalanceAccount :";
        echo $BalanceAccount->DefaultAccount->amountBalances;  echo " руб. <br />";
		  echo "DefaultAccountFalse : ";
        print_r($BalanceAccount->DefaultAccountFalse);  echo " руб. <br />";
//$args = 25176405114;
   /*      $start = date('d.m.Y',strtotime('-1 day')); 
        $startDate = (new \DateTime($start))->format('c');
        $end = date('d.m.Y',strtotime('+1 day')); 
        $endDate = (new \DateTime($end))->format('c');		

        $args = [
            'operation' => 'ALL',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'rows' => 5
        ];
     */  

   $Restrictions = $ClientApi->__call($getRestrictions);
 echo "<br />";   echo "Qiwi Class Restrictions   "; echo "<br />"; 
        echo "<pre>";
        print_r($Restrictions); echo "</pre>";
        echo "<br />";echo "<br />"; 
 

	 
  $Limits = $ClientApi->__call($getLimits);
 echo "<br />";   echo "Qiwi Class getLimits   "; echo "<br />"; 
        echo "<pre>";
        print_r($Limits); echo "</pre>";
        echo "<br />";echo "<br />";  
		
	
			
      
   $IdentificationQiwi = $ClientApi->__call($getIdentificationQiwi);
 echo "<br />";   echo "Qiwi Class IdentificationQiwi   "; echo "<br />"; 
        echo "<pre>";
        print_r($IdentificationQiwi); echo "</pre>";
        echo "<br />";echo "<br />"; 
 
  
 
 
/*  $start = date('d.m.Y H.m.s',strtotime('-1 day')); 
        $startDate = (new \DateTime($start))->format('c');
        $end = date('d.m.Y H.m.s',strtotime('+1 day')); 
        $endDate = (new \DateTime($end))->format('c');
      
       */
     
                 $start = date('d.m.Y',strtotime('-1 day')); 
                  $end = date('d.m.Y',strtotime('+1 day')); 
            /* $args = [
             'rows' => 3,
                'operation' => 'ALL',
            'startDate' => (new \DateTime($start))->format('c'),
            'endDate' => (new \DateTime($end))->format('c')
           
            ]; */
      // $args = json_encode($args, true); 
   $HistoryPayment = $ClientApi->__call($getHistoryPayment);
 echo "<br />";   echo "Qiwi Class getHistoryPayment   "; echo "<br />"; 
        echo "<pre>";
        print_r($HistoryPayment); echo "</pre>";
        echo "<br />";echo "<br />";


 //$args = '25188964756';  
       $PaymentInfo = $ClientApi->__call($getPaymentInfo, $args);
 echo "<br />";   echo "Qiwi Class getPaymentInfo   "; echo "<br />"; 
        echo "<pre>";
        print_r($PaymentInfo); echo "</pre>";
        echo "<br />";echo "<br />";

   // $args = [];
     $args = [
     'transaction_id' => $PaymentInfo->TransactionInfo->txnId,
         'type' => 'IN',
         'format' => 'PDF'
     ];
	 
	 
			
       $PaymentsTotal = $ClientApi->__call($getPaymentsTotal);
 echo "<br />";   echo "Qiwi Class getPaymentsTotal   "; echo "<br />"; 
        echo "<pre>";
        print_r($PaymentsTotal); echo "</pre>";
        echo "<br />";echo "<br />";  
            
		 
/*  $getTransactionCheque = $ClientApi->__call('getTransactionCheque', $args);
  //$TransactionCheque =  $getTransactionCheque->parseResponse();
 echo "<br />";   echo "Qiwi Class getTransactionCheque   "; echo "<br />"; 
        echo "<pre>";
        print_r($getTransactionCheque); echo "</pre>";
        echo "<br />";echo "<br />"; */
   


/*  echo "<br />";   echo "Qiwi Class methods   "; echo "<br />"; 
        echo "<pre>";
        print_r(get_class_methods($ClientApi)); echo "</pre>";
        echo "<br />";echo "<br />";  */    



?>