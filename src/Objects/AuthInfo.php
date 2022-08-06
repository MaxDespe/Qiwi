<?namespace Qiwi\Objects;


/**
 * Class balance
 * @package QiwiApi\Builder
 */
class AuthInfo 
{
        /**
    * {@inheritdoc}
    */
 /*    public function relations()
    {
        return [];
    } */
	
	public $lastLoginDate;
	
	/**
	* @var int
	*/
	public $personId;

	/**
	* @var int
	*/
	public $registrationDate;

	/**
	* @var int
	*/
	public $boundEmail;
	
	/**
	* @var int
	*/
	public $mobilePinInfo;

	/**
	* @var int
	*/
	public $passInfo;

	/**
	* @var int
	*/
	public $pinInfo;
	
	/**
	* @var int
	*/
	public $ip;
	
	
	/**
	* Message constructor.
	*
	* @param int $messageId
	* @param int $date
	* @param string $text
	* @param Chat $chat
	*/
	public function __construct($response)
	{
		$this->lastLoginDate = ( $response['lastLoginDate'] ) ? $this->setlastLoginDate($response['lastLoginDate']) : 'false';
       
		$this->personId = $response['personId'];
		$this->registrationDate = $this->setRegistrationDate($response['registrationDate']);
		
        if($response['boundEmail'] == 0){
				$this->boundEmail = "e-mail не привязан";
			}else{
				$this->boundEmail = $response['boundEmail'];
			}
            
		$this->mobilePinInfo = $this->setParseMobilePinInfo($response['mobilePinInfo']);
		$this->passInfo = $this->setParsePassInfo($response['passInfo']);
		$this->pinInfo = $this->setParsePinInfo($response['pinInfo']);
		$this->ip = $response['ip'];
	}
	
    
    
    
    		/**
	* @return get
	*/
	public function getlastLoginDate()
	{
		return new DateTimeFormat($this->lastLoginDate);
	}

    /**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setlastLoginDate($lastLoginDate)
	{
        return date("d:m:Y H:i:s", strtotime($lastLoginDate));
	} 
    
    
	/**
	* @return get
	*/
	public function getPersonId()
	{
		return $this->personId;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setPersonId($personId)
	{
	
		$this->personId = $personId;
		return $this;
	}

	/**
	* @return get
	*/
	public function getRegistrationDate()
	{   
		return new DateTimeFormat($this->registrationDate);
		
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setRegistrationDate($registrationDate)
	{
	
		return date("d:m:Y H:i:s", strtotime($registrationDate));
	}
	
	/**
	* @return get
	*/
	public function boundEmail()
	{
		return $this->boundEmail;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setboundEmail($boundEmail)
	{
	
		$this->boundEmail = $boundEmail;
		return $this;
	}
	

	public function getMobilePinInfo()
	{
		return $this->mobilePinInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setMobilePinInfo($mobilePinInfo)
	{
	
		$this->mobilePinInfo = $mobilePinInfo;
		return $this;
	}
	
	/**
	* @$ParseMobilePinInfo
	*
	* @return $this
	*/
	public function setParseMobilePinInfo($mobilePinInfo)
	{
		
		$lastMobilePinChange = $mobilePinInfo['lastMobilePinChange'];
		$nextMobilePinChange = $mobilePinInfo['nextMobilePinChange'];
	$lastMobilePin = date("d:m:Y H:i:s", strtotime($mobilePinInfo['lastMobilePinChange']));
		$nextMobilePin = date("d:m:Y H:i:s", strtotime( $mobilePinInfo['nextMobilePinChange'] ));
        
		If($mobilePinInfo['mobilePinUsed'] == 1)
		{ 
                    $result = "Используется пин код мобильного приложения <br/> Последнее изменение: ".$lastMobilePin." <br/> Следующее изменение: ". $nextMobilePin." ";
				return $result;
		}

		 else
		{
			 $result = "Пин код мобильного приложения не используется <br/>";
			return $result;
		}
		
	}	
	
	
	
	/**
	* @return get
	*/
	public function getPassInfo()
	{
		return $this->passInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setPassInfo($passInfo)
	{
	
		$this->passInfo = $passInfo;
		return $this;
	}
	
	
	/**
	* @$ParseMobilePinInfo
	*
	* @return $this
	*/
	public function setParsePassInfo($passInfo)
	{
		
		$lastPassInfo = date("d:m:Y H:i:s", strtotime($passInfo['lastPassChange']));
		$nextPassInfo = date("d:m:Y H:i:s", strtotime($passInfo['nextPassChange']));
		
		If($passInfo['passwordUsed'] == 1){
			$result = "На вход через сайт установлен пароль. <br/> Последнее изменение: ".$lastPassInfo. " <br/> Следующее изменение: ".$nextPassInfo." ";
				return $result;
		}else{
			$result = "Пароль для сайта не используется <br/>";
			return $result;
		}
		
	}	
	
	
	
	/**
	* @return get
	*/
	public function pinInfo()
	{
		return $this->pinInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setpinInfo($pinInfo)
	{
	
		$this->pinInfo = $pinInfo;
		return $this;
	}
    
    
	/**
	* @$ParseMobilePinInfo
	*
	* @return $this
	*/
	public function setParsePinInfo($pinInfo)
	{
		If($pinInfo == 1){
			$result = "Установлен PIN-код к приложению QIWI-Кошелька на QIWI терминалах";
				return $result;
		}else{
			$result = "PIN-код к QIWI Кошельку на QIWI терминалах не используется";
			return $result;
		}
		
	}

	
	/**
	* @return get
	*/
	public function getIp()
	{
		return $this->ip;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setIp($ip)
	{
	
		$this->ip = $ip;
		return $this;
	}
	
	
	/**
	* @param int $FormateRegDate
	*
	* @return $this
	*/
	public function FormateDate($items)
	{ 
        //return new \DateTime($items);
		 //$time->toDateTimeString($items);
		return date("d:m:Y H:i:s", strtotime($items));
	}
	
	
}

