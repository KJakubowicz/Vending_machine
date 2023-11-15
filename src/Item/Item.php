<?php

namespace VendingMachine\Item;

class Item implements ItemInterface
{
    private int $count;
    private float $price;
    private string $symbol;

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
