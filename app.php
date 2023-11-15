<?php

require_once 'vendor/autoload.php';

use VendingMachine\VendingMachine;
use VendingMachine\Item\Item;
use VendingMachine\Input\InputHandler;
use VendingMachine\Input\InputParser;

$A = new Item('A');
$A->setPrice(0.65);
$A->setCount(1);

$B = new Item('B');
$B->setPrice(1);
$B->setCount(1);

$C = new Item('C');
$C->setPrice(1.5);
$C->setCount(1);

$inputParser = new InputParser();
$inputHandler = new InputHandler($inputParser);
$vendingMachine = new VendingMachine();
$vendingMachine->addItem($A);
$vendingMachine->addItem($B);
$vendingMachine->addItem($C);

while (true) {
    echo "Input: ";
   
    $input = $inputHandler->getInput();
    $response = $vendingMachine->handleAction($input->getAction());

    echo $response->__toString() .  "\n";
}
