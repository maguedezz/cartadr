<?php
namespace App\App\Domain\Cart;

use Money\Currency;
use NumberFormatter;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class Money
{
    /**
     * @var mixed
     */
    public $money;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('GBP'));
    }

    /**
     * @return mixed
     */
    public function amount()
    {
        return $this->money->getAmount();
    }

    /**
     * @return mixed
     */
    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_GB', NumberFormatter::CURRENCY),
            new ISOCurrencies
        );

        return $formatter->format($this->money);
    }
}
