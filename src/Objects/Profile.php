<?php namespace Qiwi\Objects;


use Qiwi\Objects\BaseObjects;
use Qiwi\Objects\ContractInfo;
use Qiwi\Objects\AuthInfo;
use Qiwi\Objects\UserInfo;




class Profile extends BaseObjects
{
    
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return [];
    }
  

    public $ContractInfo;
	public $AuthInfo;
	public $UserInfo;
    
    

	
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
		$this->ContractInfo = new ContractInfo($response['contractInfo']);
	    $this->AuthInfo = new AuthInfo($response['authInfo']);
        $this->UserInfo = new UserInfo($response['userInfo']);
	}
    
    
	/**
	* @return get
	*/
	public function getContractInfo()
	{
		return $this->ContractInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setContractInfo($ContractInfo)
	{
		$this->ContractInfo = $ContractInfo;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function getAuthInfo()
	{
		return $this->AuthInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setAuthInfo($AuthInfo)
	{
		$this->AuthInfo = $AuthInfo;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function getUserInfo()
	{
		return $this->UserInfo;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setUserInfo($UserInfo)
	{
		$this->UserInfo = $UserInfo;
		return $this;
	}
	

}
?>
