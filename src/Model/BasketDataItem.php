<?php

namespace App\Model;

class BasketDataItem
{
    private string $id;
    private int $productId;
    private string $productName;
    private float $unitPrice;
    private float $oldUnitPrice;
    private int $quantity;
    private string $pictureUrl;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getOldUnitPrice(): float
    {
        return $this->oldUnitPrice;
    }

    public function setOldUnitPrice(float $oldUnitPrice): void
    {
        $this->oldUnitPrice = $oldUnitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPictureUrl(): string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(string $pictureUrl): void
    {
        $this->pictureUrl = $pictureUrl;
    }

}
