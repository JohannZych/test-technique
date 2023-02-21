<?php

namespace App\Events;

use App\DTO\Cart;
use App\Entity\Vat;
use App\Interfaces\CartServicesInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class CartEvent extends Event
{
    public const NAME = 'negocian.cart.dispatcher';

    public function __construct(protected Cart                   $cart,
                                protected ?CartServicesInterface $cartServices,
                                protected EntityManagerInterface $entityManager
    )
    {
        foreach ($this->cart->products as $product) {
            $vatRatio = $this->entityManager->getRepository(Vat::class)->
            findOneBy(['id' => $product['product']->getVat()])->getAmount();
            $product['vatRatio'] = $vatRatio;
            $product['atiPrice'] = $this->cartServices->calculateTTC($product['product'], $vatRatio);
            $product['total'] = $this->cartServices->calculateTotal($product['product'], $vatRatio, $product['quantity']);
        }

        $this->cartServices->calculateFinalTotal($this->cart);
    }
}