<?php namespace Qiwi\Objects;



/**
 * Class Limits
 * @package QiwiApi\Builder
 */
class Limits extends BaseObjects
{
    /**
    * {@inheritdoc}
    */
  /*    public function relations()
    {
      return $this->init();
    }  */
    
    
    /**
	* Message constructor.
	* @param ResponseDataIdentInfo
	*/
	public function __construct($response)
	{
       $limits = parent::__construct($response);
       $this->RU = $limits->limits->RU;
		/* $this->id = $response['id'];
		$this->firstName = $response['firstName'];
		$this->middleName = $response['middleName'];
		$this->lastName = $response['lastName'];
        $this->birthDate = $response['birthDate'];
		$this->passport = $response['passport'];
		$this->inn = ( $response['inn'] ) ? $response['inn'] : 'false';
		$this->snils = ( $response['snils'] ) ? $response['snils'] : 'false';
		$this->oms = ( $response['oms'] ) ? $response['oms'] : 'false';
        $this->type = $this->getParserType($response['type']); */
	}
	 
    /**
	* Message constructor.
	* @param ResponseDataIdentInfo
	*/
	public function init()
	{
       return get_class($this);
       //$this->limits =  $this->result;
		//$this->RU = $this->result->limits->RU;
		/* $this->firstName = $response['firstName'];
		$this->middleName = $response['middleName'];
		$this->lastName = $response['lastName'];
        $this->birthDate = $response['birthDate'];
		$this->passport = $response['passport'];
		$this->inn = ( $response['inn'] ) ? $response['inn'] : 'false';
		$this->snils = ( $response['snils'] ) ? $response['snils'] : 'false';
		$this->oms = ( $response['oms'] ) ? $response['oms'] : 'false';
        $this->type = $this->getParserType($response['type']); */
	}
    
      /**
	* Message constructor.
	* @param ResponseDataIdentInfo
	*/
	public static function getRawResponse()
	{
       return $data->result;
       //$this->limits =  $this->result;
		//$this->RU = $this->result->limits->RU;
		/* $this->firstName = $response['firstName'];
		$this->middleName = $response['middleName'];
		$this->lastName = $response['lastName'];
        $this->birthDate = $response['birthDate'];
		$this->passport = $response['passport'];
		$this->inn = ( $response['inn'] ) ? $response['inn'] : 'false';
		$this->snils = ( $response['snils'] ) ? $response['snils'] : 'false';
		$this->oms = ( $response['oms'] ) ? $response['oms'] : 'false';
        $this->type = $this->getParserType($response['type']); */
	}

}