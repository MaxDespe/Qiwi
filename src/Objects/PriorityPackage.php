<?php

namespace Qiwi\Objects;




/**
 * Class Nickname
 * @package QiwiApi\Builder
 */
class PriorityPackage
{
  
    

    public $priorityPackagepriceamount;   
    public $priorityPackagepricecurrency; 
    public $priorityPackageenabled;   
    public $priorityPackageautoRenewalActive;
    public $priorityPackageEndDate;

	
	
	/**
	* Message constructor.
	* @param string $response
	*/
	public function __construct($response)
	{
        $this->priorityPackagepriceamount = $response['price']['amount'];
        $this->priorityPackagepricecurrency = $response['price']['currency'];
        $this->priorityPackageenabled = ( $response['enabled'] ) ? $response['enabled'] : 'false';
        $this->priorityPackageautoRenewalActive =( $response['autoRenewalActive'] ) ? $response['autoRenewalActive'] : 'false';
        $this->priorityPackageEndDate =( $response['endDate'] ) ? $response['endDate'] : 'false';
       
	}
	
   	
		
		/**
	* @return get
	*/
	public function priorityPackageamount()
	{
		return $this->priorityPackageamount;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setpriorityPackageamount($priorityPackageamount)
	{
	
		$this->priorityPackageamount = $priorityPackageamount;
		return $this;
	}
	
		/**
	* @return get
	*/
	public function priorityPackageurrency()
	{
		return $this->priorityPackagecurrency;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setpriorityPackagecurrency($priorityPackagecurrency)
	{
	
		$this->priorityPackagecurrency = $priorityPackagecurrency;
		return $this;
	}
	
	
}
?>