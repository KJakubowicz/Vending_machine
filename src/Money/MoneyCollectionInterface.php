<?php

namespace VendingMachine\Money;

interface MoneyCollectionInterface
{
    public function add(MoneyInterface $money): void;
    public function sum(): float;
    public function merge(MoneyCollectionInterface $moneyCollection): void;
    public function empty(): void;

    /**
     * @return MoneyInterface[]
     */
    public function toArray(): array;
}
