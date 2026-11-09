<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class ProductController extends AbstractController
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/products', name: 'product_index', methods: ['GET', 'HEAD'])]
    public function index(ProductRepository $repository): Response
    {

        return $this->render('product/index.html.twig', [
            'products' => $repository->findAll(),
        ]);
    }

    #[Route('/product/{id}', name: 'product_show', methods:['GET'],
        requirements: ['id' => Requirement::DIGITS])]
    public function show(Product $product): Response
    {
    //     $product = $this->repository 
    //         ->createQueryBuilder('p')
    //         ->where('p.id = :id')
    //         ->setParameter('id', $id)
    //         ->getQuery()
    //         ->getResult();

        //$product = $this->repository->findOneBy(['id' => $id]);
        
        // $product = $this->repository->find($id);

        // if(!$product) {
        //     throw $this->createNotFoundException('Product not found');
        // }

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/product/new', name: 'product_new', methods: ['GET'])]
    public function new(): Response
    {
        $form = $this->createForm(ProductType::class);

        return $this->render('product/new.html.twig', [
            'form' => $form,
        ]);
    }
}
