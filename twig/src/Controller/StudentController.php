<?php

namespace App\Controller;

use DateTime;
use App\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    private function seedStudent() {
        //tạo object cho student 1
        $student1 = new Student;
        $student1->setId(1);
        $student1->setName("Nguyễn Tuấn Minh");
        $student1->setDob(\DateTime::createFromFormat('d/m/Y', '10/05/1999'));
        $student1->setGrade(8.5);
        $student1->setImage("s1.png");
        $student1->setGender('M');
        //tạo object cho student 2
        $student2 = new Student;
        $student2->setId(2);
        $student2->setName("Nguyễn Thùy Linh");
        $student2->setDob(\DateTime::createFromFormat('d/m/Y', '19/07/2002'));
        $student2->setGrade(9.3);
        $student2->setImage("s2.jpg");
        //tạo array chứa toàn bộ object của student
        $students = [$student1, $student2];
        return $students;
    }

    #[Route('/student')]
    public function index() 
    {
        $students = $this->seedStudent();
        return $this->render('student/index.html.twig', 
        [
             'students' => $students
        ]);
    }
}
