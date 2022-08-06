<?php namespace Qiwi\Objects;




/**
 * Class Nickname
 * @package QiwiApi\Builder
 */
class SmsNotification
{
     

    public $smsNotificationpriceamount;
    public $smsNotificationpricecurrency;    
	public $smsNotificationenabled; 
	public $smsNotificationactive;	
	public $smsNotificationendDate; 

	
	
	/**
	* Message constructor.
	* @param string $response
	*/
	public function __construct($response)
	{
	    $this->smsNotificationpriceamount =      $response['price']['amount'];
        $this->smsNotificationpricecurrency =    $response['price']['currency'];
        $this->smsNotificationenabled = ( $response['enabled'] ) ? $response['enabled'] : 'false';
        $this->smsNotificationactive = ( $response['active'] ) ? $response['active'] : 'false';
        $this->smsNotificationendDate = ( $response['endDate'] ) ? $response['endDate'] : 'false';
       
	}
	
   	
	
		/**
	* @return get
	*/
	public function smsNotificationenabled()
	{
		return $this->smsNotificationenabled;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setsmsNotificationenabled($smsNotificationenabled)
	{
	
		$this->smsNotificationenabled = $smsNotificationenabled;
		return $this;
	}
	
	
		/**
	* @return get
	*/
	public function smsNotificationactive()
	{
		return $this->smsNotificationactive;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setsmsNotificationactive($smsNotificationactive)
	{
	
		$this->smsNotificationactive = $smsNotificationactive;
		return $this;
	}
	
	
		/**
	* @return get
	*/
	public function smsNotificationendDate()
	{
		return $this->smsNotificationendDate;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setsmsNotificationendDate($smsNotificationendDate)
	{
	
		$this->smsNotificationendDate = $smsNotificationendDate;
		return $this;
	}
	
	
}
?>