<? 


namespace Qiwi\Objects;
use Qiwi\Methods\HistoryPayment;


/**
 * Class RequestHistory
 * extends HistoryPayment
 * @package 
 */
class RequestHistory 
{
    public $rows;
	public $operation;
	public $sources;
	public $startDate;
	public $endDate;
	public $nextTxnDate;
	public $nextTxnId;
	
	
	/**
	* Message constructor.
	*
	* @param int $messageId
	* @param int $date
	* @param string $text
	* @param Chat $chat
	*/
	/* public function init($DataInPut)
	{ */
	public function __construct($DataInPut)
    {
    	
        $this->rows = (int) $DataInPut['rows'];
		$this->operation = $DataInPut['operation'];
		$this->sources = $DataInPut['sources'];
		$this->startDate = (new \DateTime($DataInPut['startDates']))->format('c');
		$this->endDate = (new \DateTime($DataInPut['endDates']))->format('c');
		$this->nextTxnDate = $DataInPut['nextTxnDate'];
		$this->nextTxnId = $DataInPut['nextTxnId'];
	}
	
	/**
	* @return get
	*/
	public function getRows()
	{
		return $this->rows;
	}

	/**
	* @return get
	*/
	public function getOperation()
	{
		return $this->operation;
	}

	/**
	* @return get
	*/
	public function getSources()
	{
		return $this->sources;
	}

	/**
	* @return get
	*/
	public function getStartDate()
	{
		$this->startDate = (new \DateTime($startDate))->format('c');
		return $this->startDate;
	}

	
	/**
	* @return get
	*/
	public function getEndDate()
	{
		//$endDate(new \DateTime($enddat))->format('c');/
		return $this->endDate;
	}

	
	/**
	* @return get
	*/
	public function getNextTxnDate()
	{
		return $this->nextTxnDate;
	}

	/**
	* @return get
	*/
	public function getNextTxnId()
	{
		return $this->nextTxnId;
	}
	
	/* public function __construct()
    {
    } */
}
?>