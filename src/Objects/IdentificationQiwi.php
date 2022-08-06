<? namespace Qiwi\Objects;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class IdentificationQiwi  extends BaseObjects
{
       /**
    * {@inheritdoc}
    */
    public function relations($result)
    {
        return $result; 
    } 
        
    
	public $id; 		//Number 	Номер кошелька пользователя

	public $lastName; 	//	Фамилия пользователя
	public $firstName;	//	Имя пользователя
	public $middleName; // 	Отчество пользователя
	
    public $birthDate; 	//	Дата рождения пользователя
	public $passport; 	// 	Серия и номер паспорта пользователя (первые и последние 2 цифры)
	public $inn; 		// 	ИНН пользователя (первые и последние 2 цифры)
	public $snils; 		//	Номер СНИЛС пользователя (первые и последние 2 цифры)
	public $oms; 		// 	Номер полиса ОМС пользователя (первые и последние 2 цифры)
    public $type;	/** 	
                    *	Текущий уровень идентификации кошелька:
                    *	$SIMPLE - "Минимальный".
                    *	$VERIFIED  упрощенная идентификация (данные для идентификации успешно прошли проверку).
                    *	$FULL если кошелек уже ранее получал полную идентификацию по данным ФИО, номеру паспорта и дате рождения.
                    */
                    

 	/**
	* Message constructor.
	* @param ResponseDataIdentInfo
	*/
	public function __construct($response)
	{
		$this->id = $response['id'];
		$this->firstName = $response['firstName'];
		$this->middleName = $response['middleName'];
		$this->lastName = $response['lastName'];
        $this->birthDate = $response['birthDate'];
		$this->passport = $response['passport'];
		$this->inn = ( $response['inn'] ) ? $response['inn'] : 'false';
		$this->snils = ( $response['snils'] ) ? $response['snils'] : 'false';
		$this->oms = ( $response['oms'] ) ? $response['oms'] : 'false';
        $this->type = $this->getParserType($response['type']);
	}
	 
	
	/**
	* @return get
	*/
	public function getId()
	{
		return $this->id;
	}

	/**
	* @param 
	*/
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getType()
	{
		return $this->type;
	}

	/**
	* @param 
	*/
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getBirthDate()
	{
		return $this->birthDate;
	}

	/**
	* @param 
	*/
	public function setBirthDate($birthDate)
	{
		$this->birthDate = $birthDate;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	* @param 
	*/
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getMiddleName()
	{
		return $this->middleName;
	}

	/**
	* @param 
	*/
	public function setMiddleName($middleName)
	{
		$this->middleName = $middleName;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	* @param 
	*/
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getPassport()
	{
		return $this->passport;
	}

	/**
	* @param 
	*/
	public function setPassport($passport)
	{
		$this->passport = $passport;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getInn()
	{
		return $this->inn;
	}

	/**
	* @param 
	*/
	public function setInn($inn)
	{
		$this->inn = $inn;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getSnils()
	{
		return $this->snils;
	}

	/**
	* @param 
	*/
	public function setSnils($snils)
	{
		$this->snils = $snils;
		return $this;
	}
	
	/**
	* @return get
	*/
	public function getOms()
	{
		return $this->oms;
	}

	/**
	* @param 
	*/
	public function setOms($oms)
	{
		$this->oms = $oms;
		return $this;
	}
    
    /**
	* @return get
	*/
	public function getParserType($input)
	{
	
		if($input == 'ANONYMOUS')
		{
			$response = 'без идентификации';
		}
		elseif($input == 'SIMPLE')
		{
			$response = 'упрощенная идентификация';
		}
		elseif($input == 'VERIFIED')
		{ 
			$response = 'упрощенная идентификация';
		}
		elseif($input == 'FULL')
		{ 
			$response = 'полная идентификация';
		}
		return $response;
	}
	
}
?>