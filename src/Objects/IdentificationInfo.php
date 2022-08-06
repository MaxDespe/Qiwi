<?php namespace Qiwi\Objects;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class IdentificationInfo 
{
    
    
	
	public $bankAlias;
	
	/**
	* @var int
	*/
	public $identificationLevel;

	/**
	* @var int
	*/
	public $passportExpired;

    /**
	* @var int
	*/
	public $InfoLevelIdentofocations;

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
        for($item = 0; $item<=count($response);)
		{
			foreach($response as $ArrKeys[$item]=>$value)
			{
                $this->bankAlias = $value['bankAlias'];
                $this->identificationLevel = $value['identificationLevel'];
                $this->passportExpired = $this->ParsePassportExpired($value['passportExpired']);
                $this->InfoLevelIdentofocations = $this->getInfoLevelIdentofocations();
               echo "<br />";
            }
        $item++;	
        }
        
	}
	

    /**
	* @return get
	*/
	public function bankAlias()
	{
		return $this->bankAlias;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setbankAlias($bankAlias)
	{
		$this->bankAlias = $bankAlias;
		return $this;
	}
	
	
	/**
	* @return get
	*/
	public function identificationLevel()
	{
		return $this->identificationLevel;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setidentificationLevel($identificationLevel)
	{
	
		$this->identificationLevel = $identificationLevel;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getInfoLevelIdentofocations()
	{
	
		if($this->identificationLevel == 'ANONYMOUS')
		{
			$response = 'без идентификации';
		}
		elseif($this->identificationLevel == 'SIMPLE')
		{
			$response = 'упрощенная идентификация';
		}
		elseif($this->identificationLevel == 'VERIFIED')
		{ 
			$response = 'упрощенная идентификация';
		}
		elseif($this->identificationLevel == 'FULL')
		{ 
			$response = 'полная идентификация';
		}
		return $response;
	}
	

		/**
	* @return get
	*/
	public function passportExpired()
	{
		return $this->passportExpired;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setpassportExpired($passportExpired)
	{
	
		$this->passportExpired = $passportExpired;
		return $this;
	}

	/**
	* @$ParseMobilePinInfo
	*
	* @return $this
	*/
	public function ParsePassportExpired($passportExpired)
	{
       if($passportExpired === true){
            return "" . $passportExpired . " - true означает, что паспортные данные недействительны";
        }else{
            return " паспортные данные действительны";
        } 
	}
	
}
?>