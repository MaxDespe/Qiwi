<?php

namespace Qiwi\Objects;


/* Ответ по статистике платежей:
*    Успешный JSON-ответ содержит статистику платежей за выбранный период:
*    Поле ответа 	Тип 	Описание
*    incomingTotal 	Array[Object] 	Массив данных о суммах входящих платежей (пополнениях) по каждой валюте
*    incomingTotal[].amount 	Number(Decimal) 	Сумма пополнений за период
*    incomingTotal[].currency 	Number(3) 	Код валюты пополнений (ISO-4217)
*    outgoingTotal 	Array[Object] 	Массив данных о суммах исходящих платежей по каждой валюте
*    outgoingTotal[].amount 	Number(Decimal) 	Сумма платежей за период
*    outgoingTotal[].currency 	Number(3) 	Код валюты платежей (ISO-4217)
*
**/
class PaymentsTotal  extends BaseObjects
{
    public function __construct($response)
	{
       $PaymentsList = parent::__construct($response);
       $this->PaymentsTotal = $PaymentsList;
		
	}
}