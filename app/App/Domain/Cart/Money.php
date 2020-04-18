<?php

namespace App\App\Domain\Cart;

use Money\Currency;
use Money\Money as BaseMoney;

class Money {
	/**
	 * @var mixed
	 */
	public $money;

	/**
	 * @param $value
	 */
	public function __construct($value) {
		$this->money = new BaseMoney($value, new Currency('GBP'));
	}

	/**
	 * @return mixed
	 */
	public function amount() {
		return $this->money->getAmount();
	}
}
