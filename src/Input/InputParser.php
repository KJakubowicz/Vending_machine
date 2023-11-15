<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;
use VendingMachine\Action\ActionInterface;
use VendingMachine\Action\Action;
use VendingMachine\Money\MoneyCollection;

class InputParser implements InputParserInterface
{
    /**
     * @throws InvalidInputException
     */
    public function parse(string $input): InputInterface
    {
        if (!in_array($input, ['GET-A', 'GET-B', 'GET-C', 'RETURN-MONEY', 'N', 'D', 'Q', 'DOLLAR'])) {
            throw new InvalidInputException("Invalid Input");
        }

        return new Input(new MoneyCollection(), new Action($input));
    }
}
