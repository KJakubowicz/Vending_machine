<?php

namespace VendingMachine\Action;

use VendingMachine\Response\ResponseInterface;
use VendingMachine\VendingMachineInterface;
use VendingMachine\Item\Item;
use VendingMachine\Response\Response;
use VendingMachine\Exception\ItemNotFoundException;
use VendingMachine\Money\Money;
use VendingMachine\Money\MoneyCollectionInterface;

class Action implements ActionInterface
{
    const DENOMINATIONS = [
        'DOLLAR' => 1,
        'Q' => 0.25,
        'D' => 0.1,
        'N' => 0.05,
    ];

    const ITEMS = [
        'GET-A' => [
            'symbol' => 'A',
            'price' => 0.65,
        ],
        'GET-B' => [
            'symbol' => 'B',
            'price' => 1,
        ],
        'GET-C' => [
            'symbol' => 'C',
            'price' => 1.5,
        ],
    ];

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function handle(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        try {
            switch ($this->getName()) {
                case 'GET-A':
                case 'GET-B':
                case 'GET-C':
                    return $this->handleItem($vendingMachine);
                case 'N':
                case 'D':
                case 'Q':
                case 'DOLLAR':
                    return $this->handleMoney($vendingMachine);
                case 'RETURN-MONEY':
                    return $this->handleReturnMoney($vendingMachine);
            }
        } catch (ItemNotFoundException $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Handle return money action
     *
     * @param VendingMachineInterface $vendingMachine
     * @return ResponseInterface
     */
    private function handleReturnMoney(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $insetedMoney = $vendingMachine->getInsertedMoney()->toArray();
        $moneySymbols = array_map(fn($money) => $money->getSymbol(), $insetedMoney);
        $money = implode(', ', $moneySymbols);

        return new Response(1, $money);
    }

    /**
     * Handle money action
     *
     * @param VendingMachineInterface $vendingMachine
     * @return ResponseInterface
     */
    private function handleMoney(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $money = $this->getMoney($this->name);
        $vendingMachine->insertMoney($money);
        $insetedMoney = $vendingMachine->getInsertedMoney();
        $balance = $insetedMoney->sum();
        $symbols = implode(', ', array_map(fn($money) => $money->getSymbol(), $insetedMoney->toArray()));
        $responseMessage = 'Current balance: ' . $balance . ' (' . $symbols . ')';

        return new Response(1, $responseMessage);
    }

    /**
     * Handle item action
     *
     * @param VendingMachineInterface $vendingMachine
     * @return ResponseInterface
     */
    private function handleItem(VendingMachineInterface $vendingMachine): ResponseInterface
    {
        $item = $this->getItem($this->getName());
        $symbol = $item->getSymbol();
        $price = $item->getPrice();
        $balance = $vendingMachine->getInsertedMoney()->sum();

        if ($balance < $price) {
            return new Response(0, 'Please insert more money');
        }

        $vendingMachine->dropItem($item);

        $moneyCollection = $vendingMachine->getInsertedMoney();
        $change = $this->calculateChange($moneyCollection, $price);

        $moneyCollection->empty();

        foreach ($change as $moneySymbol => $count) {
            while ($count > 0) {
                $money = $this->getMoney($moneySymbol);
                $moneyCollection->add($money);
                $count--;
            }
        }

        return new Response(1, $symbol);
    }

    /**
     * Calculate change
     *
     * @param MoneyCollectionInterface $moneyCollection
     * @param float $price
     * @return array
     */
    private function calculateChange(MoneyCollectionInterface $moneyCollection, float $price): array
    {
        $totalAmount = $moneyCollection->sum() - $price;
        $change = [];
        foreach (self::DENOMINATIONS as $symbol => $denomination) {
            $count = floor($totalAmount / $denomination);

            if ($count > 0) {
                $change[$symbol] = (int) $count;
                $totalAmount = round($totalAmount - $count * $denomination, 2);
            }
        }

        return $change;
    }

    /**
     * Get money
     *
     * @param string $name
     * @return Money
     */
    private function getMoney(string $name): Money
    {
        return new Money(self::DENOMINATIONS[$name], $name);
    }

    /**
     * Get item
     *
     * @param string $name
     * @return Item
     */
    private function getItem(string $name): Item
    {
        $item = new Item(self::ITEMS[$name]['symbol']);
        $item->setPrice(self::ITEMS[$name]['price']);

        return $item;
    }
}
