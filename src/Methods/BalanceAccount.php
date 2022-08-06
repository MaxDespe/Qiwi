<? namespace Qiwi\Methods;



use Qiwi\Objects\Balance;
use Qiwi\Objects\BalanceFalseDefault;

/**
 * Class balance
 * @package QiwiApi\Builder
 */
class BalanceAccount extends RequestEntity
{
      /** @var string Request uri */
    public $uri = "funding-sources/v2/persons/{wallet}/accounts";

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
        return  "GET";
    }
}
?>