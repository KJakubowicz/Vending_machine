<?php

namespace VendingMachine;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Money\MoneyInterface;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\Item\ItemCollection;
use VendingMachine\Money\MoneyCollection;

class VendingMachine implements VendingMachineInterface
{
    private ItemCollection $itemCollection;
    private MoneyCollection $moneyCollection;

    public function __construct()
    {
        $this->itemCollection = new ItemCollection();
        $this->moneyCollection = new MoneyCollection();
    }

    public function addItem(ItemInterface $item): void
    {
        $this->itemCollection->add($item);
    }

    public function dropItem(ItemInterface $item): void
    {
        $this->itemCollection->get($item);
    }

    public function insertMoney(MoneyInterface $money): void
    {
        $this->moneyCollection->add($money);
    }

    public function getInsertedMoney(): MoneyCollectionInterface
    {
        return $this->moneyCollection;
    }

    public function handleAction(ActionInterface $action): ResponseInterface
    {
        return $action->handle($this);
    }
}
