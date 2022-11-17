<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    // Khai báo route => khai báo đường dẫn URL cho web
    // để kích hoạt (chạy) function tương ứng bên dưới
    // URL: 127.0.0.1:8000/greenwich => #[Route('/greenwich')]
    // URL:  127.0.0.1:8000 (homepage) => #[Route('/')]
    // name (route name) : chỉ cần khai báo để sử dụng phần path ở trong view (twig)
    #[Route('/', name: 'home')]
    //tên function là tùy chọn 
    //tham số (parameter) là không bắt buộc
    public function homepage()
    {
        //render ra web page (view)
        //thư mục mặc định của view: templates
        return $this->render("home.html.twig");
    }

    #[Route('/greenwich', name: 'gw')]
    public function test()
    {
        return $this->render("greenwich/hello.html.twig");
    }

    
}