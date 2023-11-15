<?php

namespace VendingMachine\Item;

use VendingMachine\Exception\ItemNotFoundException;

interface ItemCollectionInterface
{
    public function add(ItemInterface $item): void;

    /**
     * @throws ItemNotFoundException
     */
    public function get(ItemInterface $item): ItemInterface;

    public function count(ItemInterface $item): int;

    public function empty(): void;
}
