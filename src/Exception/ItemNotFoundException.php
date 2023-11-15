<?php

namespace VendingMachine\Exception;

use RuntimeException;

class ItemNotFoundException extends RuntimeException
{
    public function __construct(string $message = 'Item not found. Please choose another item.', int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
