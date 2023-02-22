<?php

namespace App\Services;

use App\DTO\Cart;
use App\Entity\Product;
use App\Interfaces\CartServicesInterface;

class CartServices implements CartServicesInterface
{
    public function calculateTTC(Product $product, float $vatRatio): float
    {
        // TODO: Implement calculateTTC() method.
        $price = $product->getPriceHT();
        $result = $price * (1 + ($vatRatio /100));
        return round($result, 2);
    }

    public function calculateTotal(Product $product, float $vatRatio, int $quantity ): float
    {
        // TODO: Implement calculateTotal() method.
        $price = $product->getPriceHT();
        $result = $price * (1 + ($vatRatio /100)) * $quantity;
        return round($result, 2);
    }

    public function calculateFinalTotal(Cart $cart): void
    {
        // TODO: Implement calculateFinalTotal() method.
    }
}