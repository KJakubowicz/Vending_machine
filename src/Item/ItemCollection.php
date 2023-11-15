<?php

namespace VendingMachine\Item;

use VendingMachine\Exception\ItemNotFoundException;

class ItemCollection
{
     /**
     * @var ItemInterface[]
     */
    private array $itemCollection = [];

    public function add(ItemInterface $item): void
    {
        $this->itemCollection[] = $item;
    }

    /**
     * @throws ItemNotFoundException
     */
    public function get(ItemInterface $item): ItemInterface
    {
        foreach ($this->itemCollection as $key => $itemInCollection) {
            if ($itemInCollection->getSymbol() === $item->getSymbol()) {
                unset($this->itemCollection[$key]);
                return $itemInCollection;
            }
        }

        throw new ItemNotFoundException();
    }

    public function count(ItemInterface $item): int
    {
        foreach ($this->itemCollection as $itemInCollection) {
            if ($itemInCollection->getSymbol() === $item->getSymbol()) {
                return $itemInCollection->getCount();
            }
        }
    }

    public function empty(): void
    {
        $this->itemCollection = [];
    }
}
