<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/', name: 'todo_index')]
    public function viewTodoList(TodoRepository $todoRepository)
    {
        $todos = $todoRepository->findAll();
        return $this->render(
            'todo/index.html.twig',
            [
                'todos' => $todos
            ]
        );
    }

    #[Route('/detail/{id}', name: 'todo_detail')]
    public function viewTodoDetail($id, TodoRepository $todoRepository)
    {
        $todo = $todoRepository->find($id);
        if ($todo == null) {
            $this->addFlash('Error', 'Todo not found !');
            return $this->redirectToRoute('todo_index');
        }
        return $this->render(
            'todo/detail.html.twig',
            [
                'todo' => $todo
            ]
        );
    }

    #[Route('/delete/{id}', name: 'todo_delete')]
    public function deleteTodo($id, TodoRepository $todoRepository, ManagerRegistry $managerRegistry)
    {
        $todo = $todoRepository->find($id);
        if ($todo == null) {
            // return $this->redirectToRoute('todo_index');
            $this->addFlash('Error', 'Todo not found !');
        } else {
            //gọi đến Manager (Doctrine) để xóa object (row in table)
            $manager = $managerRegistry->getManager();
            $manager->remove($todo);
            $manager->flush();
            //gửi thông báo (flash) về view
            $this->addFlash('Success', 'Todo has been deleted !');
        }
        return $this->redirectToRoute('todo_index');
    }

    #[Route('/add', name: 'todo_add')]
    public function addTodo(Request $request, ManagerRegistry $managerRegistry)
    {
    }

    #[Route('/edit/{id}', name: 'todo_edit')]
    public function editTodo($id, TodoRepository $todoRepository, Request $request, ManagerRegistry $managerRegistry)
    {
    }
}
