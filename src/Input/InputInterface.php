<?php

namespace VendingMachine\Input;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Money\MoneyCollectionInterface;

interface InputInterface
{
	public function getMoneyCollection(): MoneyCollectionInterface;
	public function getAction(): ActionInterface;
}
