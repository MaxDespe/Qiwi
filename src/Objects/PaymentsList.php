<?php

namespace Qiwi\Objects;


class PaymentsList  extends BaseObjects
{
   public function __construct($response)
	{
       $PaymentsList = parent::__construct($response);
       $this->PaymentsList = $PaymentsList['data'];
		
	}
}