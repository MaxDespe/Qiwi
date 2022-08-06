<?php namespace Qiwi\Objects;




/**
 * Class Nickname
 * @package QiwiApi\Builder
 */
class Nickname 
{
    


	/**	* @var string	*/
	public $nickname;
	public $canChange;
	
	/**	* @var string	*/
	public $canUse;
	public $description;

	
	
	/**
	* Message constructor.
	* @param string $response
	*/
	public function __construct($response)
	{
	
	    $this->nickname = ( $response['nickname'] ) ? $response['nickname'] : 'false';
        $this->canChange = ( $response['canChange'] ) ? $response['canChange'] : 'false';
        $this->canUse =  ( $response['canUse'] ) ? $response['canUse'] : 'false'; 
        $this->description = ( $response['description'] ) ? $response['description'] : 'false';
	}
	
   	
	/**
	* @return get
	*/
	public function nickname()
	{
		return $this->nickname;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setnickname($nickname)
	{
		$this->nickname = $nickname;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function canChange(): string
	{
		return $this->contractId;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setcanChange(string $canChange)
	{
		$this->canChange = $canChange;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function canUse()
	{
		return $this->canUse;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setcanUse($canUse)
	{
		$this->canUse = $canUse;
		return $this;
	}
	
		/**
	* @return get
	*/
	public function description()
	{
		return $this->description;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setdescription($description)
	{
		$this->description = $description;
		return $this;
	}
	
	
}
?>