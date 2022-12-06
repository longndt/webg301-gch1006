<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'movie_index')]
    public function index(MovieRepository $movieRepository) 
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', 
        [
            'movies' => $movies
        ]);
    }

    #[Route('/add', name: 'movie_add')]
    public function add(Request $request, ManagerRegistry $managerRegistry) {
        $movie = new Movie;
        $form = $this->createForm(MovieType::class, $movie);
        $form->add('Add', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $managerRegistry->getManager();
            $manager->persist($movie);
            $manager->flush();
            $this->addFlash('Info', 'Add movie succeed !');
            return $this->redirectToRoute('movie_index');
        }
        return $this->renderForm('movie/add.html.twig',
        [
            'movieForm' => $form
        ]);
    }

}
