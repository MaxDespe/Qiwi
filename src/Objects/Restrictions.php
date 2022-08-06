<?php namespace Qiwi\Objects;




/**
 * Class Nickname
 * @package QiwiApi\Builder
 */
class Restrictions extends BaseObjects
{
     public function __construct($response)
	{
       $Restrictions = parent::__construct($response);
       return $this->Restrictions = $Restrictions;
		
	}
}
?>

	