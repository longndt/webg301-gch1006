<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category')]
class CategoryController extends AbstractController
{
    private $repository;
    private $manager;
    private $request;
    public function __construct(CategoryRepository $categoryRepository, ManagerRegistry $managerRegistry)
    {
        $this->repository = $categoryRepository;
        $this->manager = $managerRegistry->getManager();
        // $this->request = $request;
        /* 
        - Khai báo entity repository để gọi đến các hàm: findAll(), find($id)
        - Khai báo object manager để gọi đến các hàm: remove(), persist()
        - Khai báo http request để lấy dữ liệu từ phía client (view)
        */
    }

    #[Route('/', name: 'category_index')]
    public function index()
    {
        $categories = $this->repository->findAll();
        return $this->render(
            'category/index.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

    #[Route('/delete/{id}', name: 'category_delete')]
    public function delete($id)
    {
        $category = $this->repository->find($id);

        //check xem trong category này còn chứa movie hay không
        //nếu không còn thì xóa category
        //ngược lại thì thông báo lỗi và không cho xóa
        if (count($category->getMovies()) == 0) {
            $this->manager->remove($category);
            $this->manager->flush();
            $this->addFlash('Info', 'Delete category succeed !');
        }
        $this->addFlash('Info', 'Can not delete this category');
        return $this->redirectToRoute("category_index");
    }

    #[Route('/detail/{id}', name: 'category_detail')]
    public function detail($id)
    {
        $category = $this->repository->find($id);
        return $this->render(
            'category/detail.html.twig',
            [
                'category' => $category
            ]
        );
    }
}
