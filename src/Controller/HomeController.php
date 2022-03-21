<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {

        $categories = $categoryRepository->findAll();

        $products = $productRepository->findBy(
            [],
            [
                'id' => 'DESC'
            ],
            4
        );

        return $this->render('customer/index.html.twig',[
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
