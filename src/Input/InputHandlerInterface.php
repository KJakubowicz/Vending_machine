<?php

namespace VendingMachine\Input;

use VendingMachine\Exception\InvalidInputException;

interface InputHandlerInterface
{
    /**
     * @throws InvalidInputException
     */
	public function getInput(): InputInterface;
}
