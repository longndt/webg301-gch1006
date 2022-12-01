<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'cactegory_index')]
    public function index(CategoryRepository $categoryRepository) 
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', 
        [
            'categories' => $categories
        ]);
    }
}
