<?php

namespace VendingMachine\Money;

class MoneyCollection implements MoneyCollectionInterface
{
    /**
     * @var MoneyInterface[]
     */
    private array $moneyCollection = [];

    public function add(MoneyInterface $money): void
    {
        $this->moneyCollection[] = $money;
    }

    public function sum(): float
    {
        $sum = 0;

        foreach ($this->moneyCollection as $money) {
            $sum += $money->getValue();
        }

        return $sum;
    }

    public function merge(MoneyCollectionInterface $moneyCollection): void
    {
        foreach ($moneyCollection->toArray() as $money) {
            $this->add($money);
        }
    }

    public function empty(): void
    {
        $this->moneyCollection = [];
    }

    /**
     * @return MoneyInterface[]
     */
    public function toArray(): array
    {
        return $this->moneyCollection;
    }
}