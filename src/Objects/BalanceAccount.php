<? namespace Qiwi\Objects;



use Qiwi\Objects\Balance;
use Qiwi\Objects\BalanceFalseDefault;


/**
 * Class balance
 * @package QiwiApi\Builder
 */
class BalanceAccount 
{
    

    
   //protected $BalancesList;
    public $DefaultAccount;
    public $DefaultAccountFalse;
    
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return [
            'BalancesList' => Balance::class,
            'DefaultAccount' => Balance::class,
            'DefaultAccountFalse' => Balance::class
        ];
    } 



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
       
        $List = $response['accounts'];
        foreach($List as $key => $value)
        {
            $this->BalancesList[] = $this->getBalanceRest($value);
        }
        $this->DefaultAccount = $this->getAccountTrue($response['accounts']);
        $this->DefaultAccountFalse = $this->getAccountFalse($response['accounts']);
	}
    
    
    public function getAccountTrue($balancesALL)  
	{		
		$Arr = $balancesALL;		
		foreach($Arr as $value){
			if($value['defaultAccount'] == 'true'){
                $alias = explode('_', $value['alias']);
                return $this->getBalanceRest($value);
			}
		}
		
	}
    
 
	public function miniParseBalance(){
		$this->parseBalance = $parseBalance;
		for ($d = 0; $d <= 4; $d++){
			$parseBalance = $this->balancesALL[$d];
			echo "<br />";
			
		}
		return $parseBalance;
	} 
    
    
    
	public function getAccountFalse($balancesALL)  
	{
		$AccountFalse = $balancesALL;
		
        foreach($balancesALL as $AccountFalse){
			if($AccountFalse['defaultAccount']==''){
           
				$rgResult[] = $AccountFalse;				
			}else{
                $Result = 'Более счетов не установлено в кошельке.';
            }
		}
        
        if($rgResult){
            $Result = [];
            $x = count($rgResult);
            $i = $x-1;
            for ($d = 0; $d<=$i; $d++){
                $defaultAccountFalse = $rgResult[$d];
                $Result[] = $this->getBalanceRest($defaultAccountFalse);    
                echo "<br />";
            }
        }else{
            $Result = 'Более счетов не установлено в кошельке.';
        }
        return $Result;  	
	}
    
    /**
	* @return get
	*/
	public function getBalanceRest($defaultAccountFalse)
	{
        $alias = explode('_', $defaultAccountFalse['alias']);
		
        return new Balance([
            'defaultAccount'            => $defaultAccountFalse['defaultAccount'],              
            'nameBank'                  => $defaultAccountFalse['bankAlias'], 
            'WalletAccountName'         => $defaultAccountFalse['title'], 
            'AccountDescriptionId'      => $defaultAccountFalse['type']['id'], 
            'AccountDescriptionTitle'   => $defaultAccountFalse['type']['title'], 
            'amountBalances'            => $defaultAccountFalse['balance']['amount'], 
            'currency_caption'          => strtoupper($alias[2])
        ]);
	}
    
	/**
	* @return get
	*/
	public function getDefaultAccount()
	{
		return $this->DefaultAccount;
	}

	/**
	* @return $this
	*/
	public function setDefaultAccount($DefaultAccount)
	{
		$this->DefaultAccount = $DefaultAccount;
		return $this;
	}
	
	
	/**
	* @return get
	*/
	public function getDefaultAccountFalse()
	{
		return $this->DefaultAccountFalse;
	}

	/**
	* @return $this
	*/
	public function setDefaultAccountFalse($DefaultAccountFalse)
	{
		$this->DefaultAccountFalse = $DefaultAccountFalse;
		return $this;
	}
}

?>
