<?php

namespace VendingMachine;

use VendingMachine\Action\ActionInterface;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Money\MoneyCollectionInterface;
use VendingMachine\Money\MoneyInterface;
use VendingMachine\Response\ResponseInterface;

interface VendingMachineInterface
{
    public function addItem(ItemInterface $item): void;
    public function dropItem(ItemInterface $item): void;
    public function insertMoney(MoneyInterface $money): void;
    public function getInsertedMoney(): MoneyCollectionInterface;
    public function handleAction(ActionInterface $action): ResponseInterface;
}
