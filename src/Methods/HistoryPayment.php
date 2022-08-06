<?php


namespace Qiwi\Methods;
use Qiwi\Objects\RequestHistory;
use Qiwi\Objects\ResponseHistory;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;
/**
*	 	Class HistoryPayment
*		Список платежей
*	 	Запрос выгружает список платежей и пополнений вашего кошелька.
* 		@package QiwiApi\Builder
*/
class HistoryPayment extends RequestEntity
{

   public $rows;
	public $operation;
	public $sources;
	public $startDate;
	public $endDate;
	public $nextTxnDate;
	public $nextTxnId; 
	
    
    /** @var string Request uri */
    //public $uri = "payment-history/v2/persons/{wallet}/payments/";
   
   //public $method = "GET";
    
    
    /**
     * @inheritDoc
     */
    protected function prepareUri($baseURI, $wallet)
    {
        $uri = "payment-history/v2/persons/{wallet}/payments/";
        return $baseURI.str_replace('{wallet}', $wallet, $uri);
    }
    
    /**
     * Prepare resource method
     * 
     * @return string
     */
    protected function prepareMethod()
    {
        return "GET";
    }		

   
     
     /**
     * Overridden execute method
     *
     * @param array $args
     * @param mixed $wallet
     * @param string $token
     * @param string $baseURI
     * @param ClientInterface $http_client
     * @return array
     * @throws QiwiException
     */
    public function exec(
    $wallet, 
    $token, 
    $baseURI,
    $name,    
    $args = false,
    $proxy = false,    
    ClientInterface $http_client
    ){
        $_POST['HistoryPayment'];
        self::InputDataForms();
        $getDataOut = $this->getDataOut();
       if(!$args){
           

           $args = [
                'rows' =>       $this->rows,
				'operation' =>  $this->operation,
				'sources' =>    $this->sources,
				'startDate' =>  $this->startDate,
				'endDate' =>    $this->endDate
            ]; 
        } 
          
        return parent::exec($wallet, $token, $baseURI,  $name, $this->args, $proxy, $http_client);
    }

    public function getDataOut()
	{
        if(isset($_POST['HistoryPayment']))
		{
			
            if(isset($_POST['rows']) == false){ 
                $this->rows = 10;
            }elseif(!$_POST['rows']==0){
            $this->rows= $_POST['rows'];
            }else{
                $this->rows = 10;
            } 
            
            if(isset($_POST['operations'])){
                $this->operation = $_POST['operations'];
            }else{
                $this->operation = 'ALL';
            }
            
            if(isset($_POST['insources'])){
                $this->insources= $_POST['insources'];
            }else{
                $this->insources = 'QW_RUB';
            }
            
			if(isset($_POST['startDates']) == false){
                $this->startDates = date('d.m.Y',strtotime('-1 day'));
            }elseif(!$_POST['startDates']== 0){
                $this->startDates = date('d.m.Y',strtotime($_POST['startDates']));
            }else{
                $this->startDates = date('d.m.Y',strtotime('-1 day')); 
            }
            
            if(isset($_POST['endDates']) == false){
                $this->endDates = date('d.m.Y',strtotime('-1 day'));
            }elseif(!$_POST['endDates']== 0){
                $this->endDates = date('d.m.Y',strtotime($_POST['endDates']));
            }else{
                $this->endDates = date('d.m.Y',strtotime('-1 day')); 
            }
  
			
			$DataInPut = [
				'rows'       => $this->rows,
				'operation'  => $this->operation,
				'sources'    => $this->insources,
				'startDates'  => $this->startDates,
				'endDates'    =>$this->endDates
			]; 
		
			
           $RequestHistory = new RequestHistory($DataInPut);
			var_dump($RequestHistory);
	
            $args = [
                'rows' =>       $RequestHistory->rows,
                'operation' =>  $RequestHistory->operation,
                'sources' =>    $RequestHistory->sources,
                'startDate' =>  $RequestHistory->startDate,
                'endDate' =>    $RequestHistory->endDate
            ];  

            var_dump($args);
			$this->args = $args;
			
		}
        else
		{
  
            $this->rows = '10';
            $DataInPut = [
				'rows' => $this->rows,
			]; 
            $RequestHistory = new RequestHistory($DataInPut);
			var_dump($RequestHistory);
            $args['rows']	= $this->rows;
			var_dump($args);
			$this->args = $args; 
		} 
    }


	/**
	*
    */
	static public function InputDataForms() 
	{
		?>
		<form role="form" name="HistoryPayment" method="POST" action=" "> 
		<div class="form"><label for="start">Выбрать период показа</label>
		<div class="field2"><label for="startDates">Начало</label><input type="text" id="startDates" name="startDates"></div>
		<div class="field2"><label for="endDates">Конец</label><input type="text" id="endDates" name="endDates"></div>
		<div class="field2"><label for="operations">Вид операций</label>
        <select name="operations" size="1" id="operations">
		<?php
			$Operations = array(
				"ALL"=>"Все операции", 
				"IN"=>"Входящие операции", 
				"OUT"=>"Исходящие платежи", 
				"QIWI_CARD"=>"Операции по QIWI карте" 
			);
			foreach ($Operations as $key=>$value) 
			{ 
				?><option value="<?=$key?>"><?=$value?></option><?php
			}
			?>
		</select></div>
		
		<div class="field2"><label for="insources">Счет операций</label><select name="insources" size="1" id="insources">
			<?php 
			$Sources = array(
				"QW_RUB"=>"рублевый счет кошелька", 
				"QW_USD "=>"счет кошелька в долларах", 
				"QW_EUR "=>"счет кошелька в евро", 
				"CARD "=>" банковские карты",
				"MK  "=>"счет мобильного оператора" 
			);
			foreach ($Sources as $key=>$Sourc) 
			{ 
				?><option value="<?=$key?>"><?=$Sourc?></option><?php
			}
			?>
		</select></div>
		
		<div class="field2"><label for="rows">Число операций</label>
		<input type="Integer" id="rows" name="rows"></div>
		<div class="field"><input type="submit" name="HistoryPayment" value="Отправить"></div>
		</div>
		</form>
		<?php
	}
    
    /**
	*
    */
	public function getResponseDataHistory() 
	{
         $operations = $this->responseData;
           $count = count($operations);
           var_dump($count);
    	for($w=0; $w<=$count-1;)
        {
				$operation[] = array(
				"idpo" =>$w,
				"txnIdout" =>$this->responseData[$w]['txnId'],
                "sDate" => date("d:m:Y", strtotime($this->responseData[$w]['date'])),
                "sTime" => date("H:i:s", strtotime($this->responseData[$w]['date'])),
				"statusout" =>$this->responseData[$w]['status'],
				"statusTextout"=>$this->responseData[$w]['statusText'],
				"accountout"=>$this->responseData[$w]['account'],
				"sumamountout"=>$this->responseData[$w]['sum']['amount'],
				"sumcurrencyout"=>$this->responseData[$w]['currency'],
				"totalamountout"=>$this->responseData[$w]['amount'],
				"totalcurrencyout"=>$this->responseData[$w]['currency'],
				"hystcommentout"=>$this->responseData[$w]['comment']
				);
               $w++; 
        }
		return $operation;	
        	echo "<pre>";
    var_dump($operation);
    echo "</pre>";
	}
}
?>







