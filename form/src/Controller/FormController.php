<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    //render ra form input để nhập liệu
    #[Route('/input', name: 'input')]
    public function input()
    {
        return $this->render('form/input.html.twig');
    }

    //lấy dữ liệu từ form input thông qua Request
    //render ra view output 
    #[Route('/output', name: 'output')]
    public function output(Request $request)
    {
        //lấy dữ liệu từ các input trong form
        $email = $request->get('email');
        $password = $request->get('password');
        //dùng if...else để check input value
        if ($email == "admin@gmail.com" && $password == "123456") {
            $result = "Login succeed !";
        } else {
            $result = "Login failed !";
        }
        return $this->render(
            'form/output.html.twig',
            [
                // 'email' => $email,
                // 'password' => $password
                'result' => $result
            ]
        );
    }
}
