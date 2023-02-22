<?php

namespace App\Interfaces;

use App\DTO\Cart;
use App\Entity\Product;

interface CartServicesInterface
{
    public function calculateTTC(Product $product, float $vatRatio): float;

    public function calculateTotal(Product $product, float $vatRatio, int $quantity): float;

    public function calculateFinalTotal(Cart $cart): void;
}