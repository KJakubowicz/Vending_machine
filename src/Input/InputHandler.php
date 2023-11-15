<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;
use VendingMachine\Input\InputInterface;

class InputHandler implements InputHandlerInterface
{
    private $inputParser;

    public function __construct(InputParser $inputParser)
    {
        $this->inputParser = $inputParser;
    }

    /**
     * @throws InvalidInputException
     */
    public function getInput(): InputInterface
    {
        $input = trim(fgets(STDIN));
        return $this->inputParser->parse($input);
    }
}
