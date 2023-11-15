<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;

interface InputParserInterface
{
    /**
     * @throws InvalidInputException
     */
    public function parse(string $input): InputInterface;
}
