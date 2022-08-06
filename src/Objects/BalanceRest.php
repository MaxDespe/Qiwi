<? namespace Qiwi\Objects;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class BalanceFalseDefault 
{
	
		
	public $defaultAccount;
	
	/**
	* @var int
	*/
	public $nameBank;

	/**
	* @var Chat
	*/
	public $WalletAccountName;

	/**
	* @var int
	*/
	public $AccountDescriptionId;

	/**
	* @var string
	*/
	public $AccountDescriptionTitle;

		/**
	* @var Chat
	*/
	public $amountBalances;

    	/**
	* @var int
	*/
	public $currency_caption;
	/**
	* Message constructor.
	*
	* @param int $messageId
	* @param int $date
	* @param string $text
	* @param Chat $chat
	*/
	public function __construct($data){
		
        $this->defaultAccount      = ( $data['defaultAccount'] ) ? $data['defaultAccount'] : 'false';
        $this->nameBank                = $data['nameBank'];
        $this->WalletAccountName               = $data['WalletAccountName']; 
        $this->AccountDescriptionId          = $data['AccountDescriptionId'];
        $this->AccountDescriptionTitle               = $data['AccountDescriptionTitle']; 
        $this->amountBalances         = $data['amountBalances'];
        $this->currency_caption       = $data['currency_caption'];
		
		
	}
	/**
	* @return get
	*/
	public function getdefaultAccount()
	{
		return $this->defaultAccount;
	}

		/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setdefaultAccount($defaultAccount)
	{
		$this->defaultAccount = $defaultAccount;
		return $this;
	}
	
		/**
	* @return get
	*/
	public function getnameBank()
	{
		return $this->nameBank;
	}

		/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setnameBank($nameBank)
	{
		$this->nameBank = $nameBank;
		return $this;
	}
	
		/**
	* @return get
	*/
	public function getWalletAccountName()
	{
		return $this->WalletAccountName;
	}

		/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setWalletAccountName($WalletAccountName)
	{
		$this->WalletAccountName = $WalletAccountName;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getAccountDescriptionId()
	{
		return $this->AccountDescriptionId;
	}
	
	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setAccountDescriptionId($AccountDescriptionId)
	{
		$this->AccountDescriptionId = $AccountDescriptionId;
		return $this;
	}
	
	
	/**
	* @return get
	*/
	public function getAccountDescriptionTitle()
	{
		return $this->AccountDescriptionTitle;
	}
	
	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setAccountDescriptionTitle($AccountDescriptionTitle)
	{
		$this->AccountDescriptionTitle = $AccountDescriptionTitle;
		return $this;
	}
	
	
	/**
	* @return get
	*/
	public function getamountBalances()
	{
		return $this->amountBalances;
	}
	
	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setamountBalances($amountBalances)
	{
		$this->amountBalances = $amountBalances;
		return $this;
	}
	
    	
	/**
	* @return get
	*/
	public function getcurrency_caption()
	{
		return $this->currency_caption;
	}
	
	/**
	* @param int $messageId
	*
	* @return $this
	*/
	public function setcurrency_caption($currency_caption)
	{
		$this->currency_caption = $currency_caption;
		return $this;
	}
	
	
	
}

?>
