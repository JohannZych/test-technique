<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/products', name: 'product_')]
class ProductController extends AbstractController
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '', name: 'index')]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)
            ->findProductVat();

        return $this->render('products/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route(path: '/add/{id}', name: 'add')]
    public function addProduct(Request $request, Product $product): Response
    {
        $session = $request->getSession();
        $session->set('productId_' . $product->getId(), $product);
        return $this->redirectToRoute('product_index');
    }
}