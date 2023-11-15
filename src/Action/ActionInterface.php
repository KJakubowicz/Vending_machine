<?php

namespace VendingMachine\Action;

use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;

interface ActionInterface
{
    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface;
    public function getName(): string;
}
