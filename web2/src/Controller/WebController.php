<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index() {
        return $this->render('index.html.twig');
    }

    #[Route('/hanoi', name: 'hanoi')]
    public function hanoi()
    {
        return $this->render('hanoi.html.twig');
    }

    #[Route('/hcm', name: 'hcm')]
    public function hcm()
    {
        return $this->render('hcm.html.twig');
    }

    #[Route('/danang', name: 'danang')]
    public function danang()
    {
        return $this->render('danang.html.twig');
    }

    #[Route('/cantho', name: 'cantho')]
    public function cantho()
    {
        return $this->render('cantho.html.twig');
    }
}
