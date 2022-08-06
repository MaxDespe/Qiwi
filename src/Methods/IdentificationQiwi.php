<? namespace Qiwi\Methods;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class IdentificationQiwi extends RequestEntity
{
    /** @var string Request uri */
    public $uri = "identification/v1/persons/{wallet}/identification";
    public $method = "GET";
   /**
     * Prepare resource URI
     * 
     * @param string $baseURI Base uri
     * @param string $wallet Qiwi wallet number
     * 
     * @return string
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
}
?>