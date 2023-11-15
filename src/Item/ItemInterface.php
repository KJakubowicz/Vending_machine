<?php

namespace VendingMachine\Item;

interface ItemInterface
{
    public function getCount(): int;
    public function setCount(int $count): void;
	public function getPrice(): float;
    public function setPrice(float $price): void;
    public function getSymbol(): string;
}
