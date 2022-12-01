<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActorController extends AbstractController
{
    #[Route('/actor', name: 'actor_index')]
    public function index(ActorRepository $actorRepository)
    {
        $actors = $actorRepository->findAll();
        return $this->render(
            'actor/index.html.twig',
            [
                'actors' => $actors
            ]
        );
    }
}
