<?php

namespace VendingMachine\Money;

class Money implements MoneyInterface
{
    private float $value;
    private string $symbol;

    public function __construct(float $value, string $symbol)
    {
        $this->value = $value;
        $this->symbol = $symbol;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
