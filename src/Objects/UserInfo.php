<?namespace Qiwi\Objects;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class UserInfo
{
    
      
	
	public $defaultPayCurrency;
	
	/**
	* @var int
	*/
	public $defaultPayAccountAlias;

	/**
	* @var int
	*/
	public $operator;

	/**
	* @var int
	*/
	public $language;

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
		$this->defaultPayCurrency = $response['defaultPayCurrency'];
		$this->defaultPayAccountAlias = $response['defaultPayAccountAlias'];
		$this->operator = $response['operator'];
		$this->language = $response['language'];
		$this->NumberOnePay = $response['firstTxnId'];;
	}
	
	/**
	* @return get
	*/
	public function defaultPayCurrency()
	{
		return $this->defaultPayCurrency;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setdefaultPayCurrency($defaultPayCurrency)
	{
		$this->defaultPayCurrency = $defaultPayCurrency;
		return $this;
	}
	
	
	/**
	* @return get
	*/
	public function defaultPayAccountAlias()
	{
		return $this->defaultPayAccountAlias;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setdefaultPayAccountAlias($defaultPayAccountAlias)
	{
	
		$this->defaultPayAccountAlias = $defaultPayAccountAlias;
		return $this;
	}

		/**
	* @return get
	*/
	public function operator()
	{
		return $this->operator;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setoperator($operator)
	{
	
		$this->operator = $operator;
		return $this;
	}

		/**
	* @return get
	*/
	public function language()
	{
		return $this->language;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setlanguage($language)
	{
	
		$this->language = $language;
		return $this;
	}
	
		/**
	* @return get
	*/
	public function NumberOnePay()
	{
		return $this->NumberOnePay;
	}

	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setNumberOnePay($NumberOnePay)
	{
	
		$this->NumberOnePay = $NumberOnePay;
		return $this;
	}
	
}
?>