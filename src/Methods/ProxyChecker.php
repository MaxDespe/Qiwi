<?php 

namespace Qiwi\Methods;


/**
* Proxy Checker
* Written by Sambuca
* I take no liability for how this script
* is being run
*/
class ProxyChecker
{
	
       /*	 * The URL to get to through the proxy server	 */
    private $proxy_server;
     /*	 * The URL to get to through the proxy server	 */
    private $proxy_type;
     /*	 * The URL to get to through the proxy server	 */
    private $proxy_auth; 
    /*	 * The URL to get to through the proxy server	 */
    private $url;
 


    /**
     * Instantiates a new QiwiClient object.
     *
     * @param HttpClientInterface|null $httpClientHandler
     */
    public function __construct($proxyes)
    {
        $this->proxy_server = $proxyes['server'];
        $this->proxy_type = $proxyes['type'];
        $this->proxy_auth = $proxyes['auth'];
        $this->url = 'http://www.google.com'; 
        if($this->checkProxy()) {         
            $this->result = 'true'; 
            $this->loc = $this->getLocation();  
        } else {
            $this->result = 'false'; 
            $tmp = explode(":", $this->proxy_server);
            $ip = trim($tmp[0]);  
            $this->errors = $ip; 
        }
    }

	/**
	 * Checks the status of the proxy
	 * @arg ipaddress the ip address of the proxt server
	 * @arg port the port of the proxy default 80
	 * @arg proxtType proxy, SOCKS4 or SOCKS5, default proxy
	 * @return true if the proxy works, false otherwise
	 */
    private function checkProxy() 
    {
  /*       $proxy_server = $this->proxy_server;
        $proxy_type = $this->proxy_type;
        $proxy_auth = $this->proxy_auth; 
           $url = $this->url;  */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
       
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        
        
        curl_setopt($ch, CURLOPT_PROXY, $this->proxy_server);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
       curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        
        switch ($this->proxy_type){
            
        case 'socks5':
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            break;
            
        case 'socks4':
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
            break;
            
        default:
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            break;
        }
        if(mb_strlen($this->proxy_auth)>0){
        //curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy_auth);
        }
      //  curl_setopt($ch, CURLOPT_COOKIE,'c=cookie');
       // curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36');
        curl_setopt($ch,CURLOPT_URL , $this->url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch,CURLOPT_HEADER, [
       //     'Accept: application/json',
         //   'Content-Type: application/json'
          //  ]);
      
        $content = curl_exec($ch);
        $curlInfo = curl_getinfo($ch);
         if(curl_errno($ch) || $content == ""){	
            return false; 
        } else { 
            return true;
        }
      
    }
	
	/**
	 * Gets the location of the server through its IP address
	 * @arg ipaddress the ip address of the proxy server
	 * @returns array(countryCode, countryName)
	 */
	private function getLocation()  
    {
        $ip = explode(':', $this->proxy_server);
		$data = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip={$ip}"));
		$retval = array();
		$retval["countryCode"] = $data["geoplugin_countryCode"];
		$retval["countryName"] = $data["geoplugin_countryName"];
		return $retval;
	}
    
    /**
    * Return the proxy_server for this request.
    *
    * @return string
    */
    public function getProxy_server(): string
    {
        return $this->proxy_server;
    }

    /**
    * Set the proxy_server for this request.
    *
    * @param string $proxy_server
    *
    * @return QiwiRequest
    */
    public function setProxy_server($proxy_server): self
    {
       $this->proxy = $proxy_server;
       return $this;
    }
    
     /**
    * Return the proxy_type for this request.
    *
    * @return string
    */
    public function getProxy_type(): string
    {
        return $this->proxy_type;
    }

    /**
    * Set the proxy_type for this request.
    *
    * @param string $proxy_type
    *
    * @return QiwiRequest
    */
    public function setProxy_type($proxy_type): self
    {
        $this->proxy_type = $proxy_type;
        return $this;
    }
    
     /**
    * Return the proxy_auth for this request.
    *
    * @return string
    */
    public function getProxy_auth(): string
    {
        return $this->proxy_auth;
    }

    /**
    * Set the proxy_auth for this request.
    *
    * @param string $proxy_auth
    *
    * @return QiwiRequest
    */
    public function setProxy_auth($proxy_auth): self
    {
       $this->proxy_auth = $proxy_auth;
       return $this;
    }
    
     /**
    * Return the headers for this request.
    *
    * @return string
    */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
    * Set the result for this request.
    *
    * @param string $result
    *
    * @return QiwiRequest
    */
    public function setResult($result): self
    {
       $this->result = $result;
       return $this;
    }
}
?>