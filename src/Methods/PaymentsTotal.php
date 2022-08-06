<?php

namespace Qiwi\Methods;
use Qiwi\Objects\RequestHistory;
use Qiwi\Objects\ResponseHistory;
use GuzzleHttp\ClientInterface;
use Qiwi\Exceptions\InvalidArgumentsException;
use Qiwi\Exceptions\QiwiException;

  /*     
    Статистика платежей

    Запрос используется для получения сводной статистики по суммам платежей за указанный период.

        Данные параметры передаются в строке запроса:

    Название 	Тип 	Описание
    startDate 	DateTime URL-encoded 	Начальная дата периода статистики. Дату можно указать в любой временной зоне TZD (формат ГГГГ-ММ-ДД'T'чч:мм:ссTZD), однако она должна совпадать с временной зоной в параметре endDate. Обозначение временной зоны TZD: +чч:мм или -чч:мм (временной сдвиг от GMT). Обязательный параметр
    endDate 	DateTime URL-encoded 	Конечная дата периода статистики. Дату можно указать в любой временной зоне TZD (формат ГГГГ-ММ-ДД'T'чч:мм:ссTZD), однако она должна совпадать с временной зоной в параметре startDate. Обозначение временной зоны TZD: +чч:мм или -чч:мм (временной сдвиг от GMT). Обязательный параметр
    operation 	String 	Тип операций, учитываемых при подсчете статистики. Допустимые значения:
        ALL - все операции,
        IN - только пополнения,
        OUT - только платежи,
        QIWI_CARD - только платежи по картам QIWI (QVC, QVP).
        По умолчанию ALL.
    sources 	Array[String] 	Источники платежа, по которым вернутся данные. Каждый источник нумеруется, начиная с нуля (sources[0], sources[1] и т.д.). 
    Допустимые значения:
        QW_RUB - рублевый счет кошелька,
        QW_USD - счет кошелька в долларах,
        QW_EUR - счет кошелька в евро,
        CARD - привязанные и непривязанные к кошельку банковские карты,
        MK - счет мобильного оператора. Если не указан, учитываются все источники платежа. 
    */
class PaymentsTotal extends RequestEntity
{
    /** @var string Request uri */
    public $uri = "payment-history/v2/persons/{wallet}/payments/total/";

   
    public $method = "GET";
    
    
    /**
     * @inheritDoc
     */
    protected function prepareUri($baseURI, $wallet)
    {
        return $baseURI.str_replace('{wallet}', $wallet, $this->uri);
    }
    
    /**
     * Prepare resource method
     * 
     * @return string
     */
    protected function prepareMethod()
    {
        return $this->method;
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
        $_POST['PaymentsTotal'];
        self::InputDataForms();
        $getDataOut = $this->getDataOut();
       if(!$args){
           

           $args = [
                'startDate' =>  $this->startDate,
				'endDate' =>    $this->endDate,
              	'operation' =>  $this->operation,
				'sources' =>    $this->sources,
            ]; 
        } 
          
        return parent::exec($wallet, $token, $baseURI,  $name, $this->args, $proxy, $http_client);
    }
    
    
    public function getDataOut()
	{
        
		
        if(isset($_POST['PaymentsTotal']))
		{
			//$this->rows      = $_POST['rows'];
            /* if(isset($_POST['rows']) == false){ 
                $this->rows = 10;
            }elseif(!$_POST['rows']==0){
            $this->rows= $_POST['rows'];
            }else{
                $this->rows = 10;
            }  */
            
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
                $this->endDates = date('d.m.Y',strtotime('+1 day'));
            }elseif(!$_POST['endDates']== 0){
                $this->endDates = date('d.m.Y',strtotime($_POST['endDates']));
            }else{
                $this->endDates = date('d.m.Y',strtotime('+1 day')); 
            }
            
			/* $this->insources  = $_POST['insources'];
			$this->startDates = $_POST['startDates'];
			$this->endDates   = $_POST['endDates']; */
			
			$DataInPut = [
				'rows'       => 1,
				'operation'  => $this->operation,
				'sources'    => $this->insources,
				'startDates'  => $this->startDates,
				'endDates'    =>$this->endDates
			]; 
		
			
           $RequestHistory = new RequestHistory($DataInPut);
			var_dump($RequestHistory);

            $args = [
                //'rows' =>       $RequestHistory->rows,
                'startDate' =>  $RequestHistory->startDate,
                'endDate' =>    $RequestHistory->endDate,
                'operation' =>  $RequestHistory->operation,
                'sources' =>    $RequestHistory->sources,
               
            ];  
		;
            var_dump($args);
			$this->args = $args;
			
		}
        else
		{
           // self::InputDataForms();
            $this->operation = 'ALL';
			$this->startDates = date('d.m.Y',strtotime('-30 day'));
            $this->endDates = date('d.m.Y',strtotime('+1 day')); 
            $this->insources = 'QW_RUB'; 
            
            $DataInPut = [
                'rows'       => 1,
                'startDates' =>  $this->startDates,
                'endDates' =>    $this->endDates,
				'operations' => $this->operation,
                'sources' =>   $this->insources
			]; 

            $RequestHistory = new RequestHistory($DataInPut);
			var_dump($RequestHistory);
            $args = [
              
                'startDate' =>  $RequestHistory->startDate,
                'endDate' =>    $RequestHistory->endDate,
                'operation' =>  $RequestHistory->operation,
                'sources' =>    $RequestHistory->sources,
               
            ];  
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
		<form role="form" name="PaymentsTotal" method="POST" action=" "> 
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
		<div class="field"><input type="submit" name="PaymentsTotal" value="Отправить"></div>
		</div>
		</form>
		<?php
	}
	
}