<?php

namespace Qiwi\Objects;

use Qiwi\Objects\Nickname;
use Qiwi\Objects\IdentificationInfo;
use Qiwi\Objects\SmsNotification;
use Qiwi\Objects\PriorityPackage;

/**
 * Class ContractInfo
 * @package QiwiApi\Builder
 */
class ContractInfo 
{
   
    
    
	
	public $contractId;
	
	/**
	* @var int
	*/
	public $nickname;

	/**
	* @var int
	*/
	public $creationDate;
	
	
	/**
	* @var int
	*/
	public $identificationInfo;
	
	
	/**
	* @var int
	*/
	public $smsNotification;
	
	/**
	* @var int
	*/
	public $priorityPackage;
	
	/**
	* @var int
	*/
	public $blocked;
	
	
	
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
		$this->contractId = $response['contractId'];
	    $this->nickname = new Nickname($response['nickname']);
        $this->creationDate =  $this->setCreationDate($response['creationDate']);
        $this->identificationInfo = new IdentificationInfo($response['identificationInfo']);
        $this->smsNotification = new SmsNotification($response['smsNotification']);
        $this->priorityPackage = new PriorityPackage($response['priorityPackage']);
        $this->blocked = $this->setBlock($response['blocked']);
	}
	
	/**
	* @return get
	*/
	public function getContractId()
	{
		return $this->contractId;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setContractId($contractId)
	{
		$this->contractId = $contractId;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function getNickname()
	{
		return $this->nickname;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setNickname($nickname)
	{
		$this->nickname = $nickname;
		return $this;
	}
	
  	
		/**
	* @return get
	*/
	public function getCreationDate()
	{
		return new DateTimeFormat($this->creationDate);
	}

    /**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setCreationDate($creationDate)
	{
        return date("d:m:Y H:i:s", strtotime($creationDate));
	} 	
		/**
	* @return get
	*/
	public function getIdentificationInfo()
	{
		return $this->identificationInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setIdentificationInfo($identificationInfo)
	{
		$this->identificationInfo = $identificationInfo;
		return $this;
	}
	
    /**
	* @return get
	*/
	public function getSmsNotification()
	{
		return $this->SmsNotification;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setSmsNotification($smsNotification)
	{
		$this->SmsNotification = $smsNotification;
		return $this;
	}
	
	
		/**
	* @return get
	*/
	public function getPriorityPackage()
	{
		return $this->priorityPackage;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setPriorityPackageamount($priorityPackageamount)
	{
	
		$this->priorityPackageamount = $priorityPackageamount;
		return $this;
	}
	
	

		/**
	* @return get
	*/
	public function getBlocked()
	{   
		return $this->blocked;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setBlocked($blocked)
	{
        $this->blocked = $blocked;
		return $this;
	}
    
    	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setBlock($blocked)
	{
        if(!$blocked = false){
            return 'Не блокирован';
            
        }else{  
            return 'Блокировка'.$blocked.'';
        }		
		
	}
}
?>