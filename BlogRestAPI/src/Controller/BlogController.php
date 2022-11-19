<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BlogController extends AbstractController
{



    #[Route('/', methods: 'GET', name: 'view_all_blog_api')]
    public function viewAllBlog(BlogRepository $blogRepository, SerializerInterface $serializer)
    {
        //1) lấy dữ liệu từ DB và lưu vào array
        //SQL query tương ứng: "SELECT * FROM Blog"
        //Cách 1: dùng getDoctrine() và không cần khai báo parameter (tham số)
        //$blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
        //Cách 2: dùng Repository, bắt buộc phải khai báo tham số (recommended)
        $blogs = $blogRepository->findAll();

        // 2) chuyển đổi array thành api (json hoặc xml)
        //$api = $serializer->serialize($blogs, 'xml');
        $api = $serializer->serialize($blogs, 'json');

        //3) trả về api cho front-end
        return new Response($api,200,
            [
                'content-type' => 'application/json'
            ]
        );
        //Note: 200 => Response::HTTP_OK
    }
}
