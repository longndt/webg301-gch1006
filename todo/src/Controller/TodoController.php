<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
