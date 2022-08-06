 Клиент QIWI кошелька работающий через прокси сервер.
 Каждому кошельку должен быть присвоен свой прокси сервер. Без прокси работать не будет. 
Изпользуется guzzle client.
 
 
## START
```


require __DIR__ . '/vendor/autoload.php';

use Qiwi\Client;

	$iAccount номер кошелька 
	$qwtoken - токен кошелька 
	$proxy_server = 'IP:PORT';
	$proxy_auth = 'pass:login';
	$proxy_type = 'https/soks5'; 
		
		$proxyesarr = array(
			'server' => $proxy_server,
			'auth' => $proxy_auth,
			'type' => $proxy_type, 
		);
		
$ClientApi = new Client($iAccount, $qwtoken, $proxyesarr);
```
И Вы увидите все доступные методы работы 
