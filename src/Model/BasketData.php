<?php

namespace App\Model;

class BasketData
{
    private string $buyerId;
    private array $items = [];

    public function getBuyerId(): string
    {
        return $this->buyerId;
    }

    public function setBuyerId(string $buyerId): void
    {
        $this->buyerId = $buyerId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function addItem(BasketDataItem $item): void
    {
        $this->items[] = $item;
    }

}
