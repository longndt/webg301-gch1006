<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    private $blogRepository;
    private $registry;
    public function __construct(BlogRepository $blogRepository, ManagerRegistry $managerRegistry)
    {
        $this->blogRepository = $blogRepository;
        $this->registry = $managerRegistry;
    }

    #[Route('/', methods: ['GET'], name: 'view_all_blog_api')]
    public function viewAllBlog(SerializerInterface $serializer)
    {
        //1) lấy dữ liệu từ DB và lưu vào array
        //SQL query tương ứng: "SELECT * FROM Blog"
        //Cách 1: dùng getDoctrine() và không cần khai báo parameter (tham số)
        //$blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
        //Cách 2: dùng Repository, bắt buộc phải khai báo tham số (recommended)
        $blogs = $this->blogRepository->findAll();

        // 2) chuyển đổi array thành api (json hoặc xml)
        //$api = $serializer->serialize($blogs, 'xml');
        $api = $serializer->serialize($blogs, 'json');

        //3) trả về api cho front-end
        return new Response(
            $api,
            200,
            [
                'content-type' => 'application/json',
                'Access-Control-Allow-Origin' => '*'
            ]
        );
        //Note: 200 => Response::HTTP_OK
    }

    #[Route('/{id}', methods: ['GET'], name: 'view_blog_by_id')]
    public function viewBlogById($id, SerializerInterface $serializer)
    {
        //SQL: SELECT * FROM Blog WHERE id = '$id'
        $blog = $this->blogRepository->find($id);
        //check if blog is null return status code: 404 - Not Found
        if ($blog == null) {
            $error = "<center><h1 style='color: red;'><i><u>Blog not found !</u></i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_NOT_FOUND,
                [
                    'content-type' => 'text/html'
                ]
            );
        }

        $api = $serializer->serialize($blog, 'xml');
        return new Response(
            $api,
            Response::HTTP_OK,
            [
                'content-type' => 'application/xml',
                // 'IDE' => 'VS Code',
                // 'Purpose' => 'View Blog By Id'
            ]
        );
    }

    //SQL: DELETE FROM Blog WHERE id = '$id'
    #[Route('/{id}', methods: 'DELETE', name: 'delete_blog')]
    public function deleteBlog($id)
    {
        $blog = $this->blogRepository->find($id);
        if ($blog == null) {
            //trả về response cho client với thông báo
            $error = "<center><h1 style='color: red;'><i><u>Blog is not existed !</u></i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_BAD_REQUEST, //code: 400
                [
                    'content-type' => 'text/html'
                ]
            );
        } else {
            //khởi tạo biến để gọi đến Entity Manager
            $manager = $this->registry->getManager();
            //xóa record ($blog) khỏi table (entity)
            $manager->remove($blog);
            //confirm thao tác xóa
            $manager->flush();
            //trả về response cho client với thông báo
            $info = "<center><h1 style='color: blue;'><i><u>Blog has been deleted !</u></i></h1></center>";
            return new Response(
                $info,
                Response::HTTP_ACCEPTED, //code: 202
                [
                    'content-type' => 'text/html'
                ]
            );
        }
    }

    //SQL: INSERT INTO Blog (title, author, content, date) VALUES(.....) 
    #[Route('/', methods: 'POST', name: 'add_new_blog')]
    public function addBlog(Request $request)
    {
        //tạo mới object Blog
        $blog = new Blog;
        //lấy dữ liệu từ Request của client theo format của json
        $data = json_decode($request->getContent(), true);
        //set giá trị cho từng thuộc tính (dữ liệu của từng cột)
        $blog->setTitle($data['title']);
        $blog->setAuthor($data['author']);
        $blog->setContent($data['content']);
        $blog->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
        //khai báo Entity Manager
        $manager = $this->registry->getManager();
        //add dữ liệu vào DB
        $manager->persist($blog);
        $manager->flush();
        //trả về response
        //C1: trả về 1 message
        $success = "<center><h1 style='color: blue;'><i><u>Add new blog succeed !</u></i></h1></center>";
        return new Response(
            $success,
            Response::HTTP_CREATED, //201
            [
                'content-type' => 'text/html'
            ]
        );
    }

    //SQL: UPDATE Blog SET title = ..., .... WHERE id = '$id'
    #[Route('/{id}', methods: 'PUT', name: 'update_blog')]
    public function editBlog($id, Request $request)
    {
        //lấy dữ liệu của Blog theo id từ database
        $blog = $this->blogRepository->find($id);
        if ($blog == null) {
            //trả về response cho client với thông báo
            $error = "<center><h1 style='color: red;'><i><u>Blog is not existed !</u></i></h1></center>";
            return new Response(
                $error,
                Response::HTTP_BAD_REQUEST, //code: 400
                [
                    'content-type' => 'text/html'
                ]
            );
        } 
        //lấy dữ liệu từ Request của client theo format của json
        $json = $request->getContent();
        $data = json_decode($request->getContent(), true);
        //set giá trị cho từng thuộc tính (dữ liệu của từng cột)
        $blog->setTitle($data['title']);
        $blog->setAuthor($data['author']);
        $blog->setContent($data['content']);
        $blog->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
        //khai báo Entity Manager
        $manager = $this->registry->getManager();
        //add dữ liệu vào DB
        $manager->persist($blog);
        $manager->flush();
        //trả về response
        // C2: trả về giá trị của $json
        return new Response(
            $json,
            201,
            [
                'content-type' => 'application/json'
            ]
        );
    }
}
