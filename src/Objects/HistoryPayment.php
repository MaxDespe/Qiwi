<? namespace Qiwi\Objects;




/**
 * Class ResponseHistory
 * @package 
 */
class HistoryPayment extends BaseObjects
{
	
	public $txnId;		//ID транзакции в процессинге QIWI Wallet
	public $personId;	//Номер кошелька
	public $date;
	public $errorCode;	//Код ошибки платежа
	public $error; 		//Описание ошибки
	public $status;		//WAITING - платеж проводится,  SUCCESS - успешный платеж,  ERROR - ошибка платежа.
	public $type; 		//Tип платежа.
	public $statusText; // Success
	public $trmTxnId;	//Клиентский ID транзакции
	public $account; 	//Для платежей - номер счета получателя. 
						//		Для пополнений - номер отправителя, терминала или название агента пополнения кошелька
	public $sum;		//Данные о сумме платежа или пополнения. Параметры:amount;currency
	public $commission;	//Данные о комиссии платежа. Параметры:amount;currency
	public $total;		//Данные об общей сумме платежа или пополнения. Параметры:amount;currency
	public $providerid;	//ID провайдера в QIWI Wallet,
	public $shortName;	//краткое наименование провайдера,
	public $longName;	//развернутое наименование провайдера,
	public $logoUrl;	//ссылка на логотип провайдера,
	public $comment;	//Комментарий к платежу
	public $currencyRate;//Курс конвертации (если применяется в транзакции)
	public $nextTxnId;
	public $nextTxnDate;
	
	/**
	* Message constructor.
	*
	* @param int $messageId
	* @param int $date
	* @param string $text
	* @param Chat $chat
	*/
	//function __construct($txnId, $personId, $date, $errorCode, $error, $status, $type, $trmTxnId, $account, $sum, $commission, $total, $providerid, $shortName, $longName, $logoUrl, $comment, $currencyRate,$nextTxnId, $nextTxnDate)
	public function __construct($responses)
	{
      parent::__construct($responses['data']);
      
       if($responses){
         return  $this->arrayHistory( $responses['data'] );
        }
       

       //$result = $responses['data'];
        // var_dump( $result);
       //if($responses) foreach ($responses['data'] as $response):
      // foreach( $result as $key => $response ) {
      /* $count = count($result);
       var_dump( $count);
      for($i=0; $i<=$count; ){
        $response = $result[$i]; */
		

    /*     $this->txnId = $response['txnId'];         				// $this->txnId = $txnId;
		$this->personId = $response['personId'];         		// $this->personId = $personId;
		// $this->date = $response['date'];         				// $this->_date = $date;
		 $this->errorCode = $response['errorCode'];       		// $this->errorCode = $errorCode;
		 $this->error = $response['error'];        				// $this->error = $error;
		 $this->status = $response['status'];         			// $this->status = $status;
		$this->type = $response['type'];         				// $this->type = $type;
		 $this->trmTxnId = $response['trmTxnId'];         		// $this->trmTxnId = $trmTxnId;
		 $this->account = $response['account'];         		// $this->account = $account;
		 $this->sum = $response['sum'];         				// $this->sum = $sum;
		 $this->commission = $response['commission'];     		// $this->commission = $commission;
		 $this->total = $response['total'];                     // $this->total = $total;
          $this->providerid = $response['provider']['id'];
		 $this->shortName = $response['provider']['shortName']; // $this->shortName = $shortName;
		 $this->longName = $response['provider']['longName'];   // $this->longName = $longName;
		 $this->logoUrl = $response['provider']['logoUrl'];     // $this->logoUrl = $logoUrl;
		 $this->comment = $response['comment'];		    		// $this->comment = $comment;
		 $this->currencyRate = $response['currencyRate'];			// $this->currencyRate = $currencyRate;
		 $this->nextTxnId = $response['nextTxnId'];				// $this->nextTxnId = $nextTxnId;
		 $this->nextTxnDate = $response['nextTxnDate'];    		// $this->nextTxnDate = $nextTxnDate;
       */
       
       
       //endforeach;
        //$i++;
      //}
      
	}
	
	public function arrayHistory( array $array ) {
		echo '<br><br>История транзакций<br><table width=80%>';
		echo '<tr><td>ID</td><td>Время</td><td>Статус</td><td>Тип</td><td>Сумма</td><td>Комментарий</td></tr>';
		foreach( $array as $key => $val ) {
			if($val['status']=='SUCCESS'){$val['status']='<font color="gren"><b> Выполнен </b></font>';}
			if($val['status']=='WAITING'){$val['status']='Обработка';}
			if($val['status']=='ERROR'){$val['status']='<font color="RED"><b>  Ошибка (код ошибки '.$val['errorCode'].')</b></font>';}
			
			if($val['type']=='OUT'){$val['type']='<font color="blue">  Оплата '.$val['account'].' ( '. $val['provider']['shortName'] .')</font>';}
			if($val['type']=='IN'){$val['type']='<font color="green">  Пополнение '. $val['personId'] .' ( '. $val['provider']['shortName'] .')</font>';}
			if($val['type']=='QIWI_CARD'){$val['type']='<font color="orange"> Пополнение карты'. $val['personId'] .')</font>';}
			
			echo '<tr><td>'.$val['txnId'] .'</td>';
			echo '<td>Дата: '.  date("d:m:Y", strtotime($val['date'])) .'  в  '.  date("H:i:s", strtotime($val['date'])) .'</td>';
			echo '<td>'.$val['status'] .'</td>';
			echo '<td>'.$val['type'] .'</td>';
			echo '<td>'.$val['sum']['amount'] .' +  '. $val['commission']['amount'] .'  (комиссия) = <b>'. $val['total']['amount'] .'</b></td>';
            echo '<td>'.$val['comment'].'</b></td></tr>';
		}
		echo '</table>';
	}
	/* /* * 
	* @return array|bool
	*/
    /* public function loadKeysPaymentsHistory($PaymentsHistory)
	{
		for($i=0; $i<=count($PaymentsHistory); ){
			$keys[] = $PaymentsHistory[$i];
			$i++;
		}
		$items = $keys[0];
		$key = array_keys($items);
	} */ 
	
	/* * 
	* @return array|bool
	*/
  /*  	public static function KeysInfo($ArrKeys)
	{
		for($item = 0; $item<=count($ArrKeys);)
		{
			foreach(self::loadAcountInfo() as $ArrKeys[$item]=>$value)
			{
				return $value ."<br />";
			}
			$item++;			
		}
	} */
	
	
	
	
	
	
	/**
	* @return txnId
	*/
	public function txnId()
	{
		return $this->txnId;
	}

	public function settxnId($txnId)
	{
		$this->txnId = $txnId;
		return $this;
	}

	/**
	* @return personId
	*/
	public function personId()
	{
		return $this->personId;
	}

	public function setpersonId($personId)
	{
		$this->personId = $personId;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function per_date()
	{
		return $this->_date;
	}

	public function set_date($date)
	{
		$this->_date = $date;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function errorCode()
	{
		return $this->errorCode;
	}
	
	/**
	* @return personId
	*/
	public function seterrorCode($errorCode)
	{
		$this->errorCode = $errorCode;
		return $this;
	}
	
	
	/**
	* @return error
	*/
	public function error()
	{
		return $this->error;
	}
	
	/**
	* @return personId
	*/
	public function seterror($error)
	{
		$this->error = $error;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function status()
	{
		return $this->status;
	}
	
	/**
	* @return personId
	*/
	public function setstatus($status)
	{
		$this->status = $status;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function type()
	{
		return $this->type;
	}

	public function setype($type)
	{
		$this->type = $type;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function trmTxnId()
	{
		return $this->trmTxnId;
	}

	public function settrmTxnId($trmTxnId)
	{
		$this->trmTxnId = $trmTxnId;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function account()
	{
		return $this->account;
	}

	public function setaccount($account)
	{
		$this->account = $account;
		return $this;
	}
	
	
	/**
	* @return sum
	*/
	public function sum()
	{
		return $this->sum;
	}

	public function setsum($sum)
	{
		$this->sum = $sum;
		return $this;
	}
	
	
	/**
	* @return commission
	*/
	public function commission()
	{
		return $this->commission;
	}

	public function setcommission($commission)
	{
		$this->commission = $commission;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function total()
	{
		return $this->total;
	}

	public function settotal($total)
	{
		$this->total = $total;
		return $this;
	}
	
	
	/**
	* @return personId
	*/
	public function shortName()
	{
		return $this->shortName;
	}

	public function setshortName($shortName)
	{
		$this->shortName = $shortName;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function longName()
	{
		return $this->longName;
	}

	public function setlongName($longName)
	{
		$this->longName = $longName;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function logoUrl()
	{
		return $this->logoUrl;
	}

	public function setlogoUrl($logoUrl)
	{
		$this->logoUrl = $logoUrl;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function comment()
	{
		return $this->comment;
	}

	public function setcomment($comment)
	{
		$this->comment = $comment;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function currencyRate()
	{
		return $this->currencyRate;
	}

	public function setcurrencyRate($currencyRate)
	{
		$this->currencyRate = $currencyRate;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function nextTxnId()
	{
		return $this->nextTxnId;
	}

	public function setnextTxnId($nextTxnId)
	{
		$this->nextTxnId = $nextTxnId;
		return $this;
	}
	
	/**
	* @return personId
	*/
	public function nextTxnDate()
	{
		return $this->nextTxnDate;
	}

	public function setnextTxnDate($nextTxnDate)
	{
		$this->nextTxnDate = $nextTxnDate;
		return $this;
	}
	
}
	