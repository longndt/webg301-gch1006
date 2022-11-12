<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    //Route: Set đường dẫn (URL) cho website
    //Khi URL khớp với Route thì kích hoạt (chạy) function
    //tương ứng bên dưới
    //Route là duy nhất
    #[Route('/hanoi')]
    public function hanoi()
    {
        //render ra view (thư mục chứa view: templates)
        return $this->render('vietnam/hanoi.html');
    }

    //muốn set trang home thì để route là '/'
    #[Route('/')]
    public function danang()
    {
        return $this->render('vietnam/danang.html');
    }
}
