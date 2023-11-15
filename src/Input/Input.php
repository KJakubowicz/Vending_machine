<?php

namespace VendingMachine\Input;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Money\MoneyCollectionInterface;

class Input implements InputInterface
{
    private MoneyCollectionInterface $moneyCollection;
    private ActionInterface $action;

    public function __construct(MoneyCollectionInterface $moneyCollection, ActionInterface $action)
    {
        $this->moneyCollection = $moneyCollection;
        $this->action = $action;
    }

    public function getMoneyCollection(): MoneyCollectionInterface
    {
        return $this->moneyCollection;
    }
    public function getAction(): ActionInterface
    {
        return $this->action;
    }
}
