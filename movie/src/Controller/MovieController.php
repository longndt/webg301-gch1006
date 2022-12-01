<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'movie_index')]
    public function index(MovieRepository $movieRepository) 
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', 
        [
            'movies' => $movies
        ]);
    }
}
