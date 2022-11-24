<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }

    #[Route('/worldcup', name: 'world_cup_2022')]
    public function worldcup2022()
    {
        return $this->render('worldcup.html.twig');
    }

    #[Route('/', name: 'home')]
    public function homepage()
    {
        $year = 2022;
        $country = "Vietnam";
        $datetime = DateTime::createFromFormat('d/m/Y H:i:s', '24/11/2022 09:09:45');
        $students = ['Minh', 'Nam', 'Huong', 'Linh', 'Tuan', 'Phong', 'Hung'];
        return $this->render(
            'home.html.twig',
            [
                'namhientai' => $year,  //integer
                'country' => $country,  //string
                'grade' => 7.5,  //float
                'gender' => 'F',  //character
                'pass' => false, //boolean
                'datetime' => $datetime, //datetime
                'student_list' => $students //array
            ]
        );
    }
}
