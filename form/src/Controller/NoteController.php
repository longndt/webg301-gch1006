<?php

namespace App\Controller;

use App\Entity\Note;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NoteController extends AbstractController
{
    #[Route('/addnote', name: 'add_note')]
    public function addNote()
    {
        $note = new Note;
        $form = $this->createFormBuilder($note)
            ->add('title', TextType::class)
            ->add('content', TextType::class)
            ->add('Add', SubmitType::class)
            ->getForm();
        return $this->render(
            'note/add.html.twig',
            [
                'noteForm' => $form->createView()
            ]
        );
    }

    #[Route('/viewnote', name: 'view_note')]
    public function viewNote()
    {
        return $this->render('note/view.html.twig');
    }
}
