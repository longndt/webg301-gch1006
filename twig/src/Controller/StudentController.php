<?php

namespace App\Controller;

use DateTime;
use App\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/student')]
    public function index() 
    {
        $student1 = new Student;
        $student1->setId(1);
        $student1->setName("Nguyen Tuan Minh");
        $student1->setDob(DateTime::createFromFormat('d/m/Y', '10/05/2022'));
        $student1->setGrade(8.5);
        $student1->setImage("s1.png");
        return $this->render('student/index.html.twig', 
        [
             'student' => $student1
        ]);
    }
}
