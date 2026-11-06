<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $products = [
            ['name' => 'Product 1', 'price' => 10.99],
            ['name' => 'Product 2', 'price' => 19.99],
            ['name' => 'Product 3', 'price' => 5.99],
        ];  
        
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
