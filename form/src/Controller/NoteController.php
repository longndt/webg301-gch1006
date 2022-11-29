<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends AbstractController
{
    //Cách 1: tạo form bằng createFormBuilder()
    #[Route('/addnote', name: 'add_note')]
    public function addNote(Request $request)
    {
        //tạo object Note dựa trên entity Note
        $note = new Note;
        //tạo form chứa các input tương ứng với attribute của entity Note
        //thông tin nhập vào form sẽ lưu vào object Note
        $form = $this->createFormBuilder($note)
            ->add('title', TextType::class)
            ->add('content', TextType::class)
            ->add('Add', SubmitType::class)
            ->getForm();
        //handle request từ client (form)
        $form->handleRequest($request);
        //check xem form đã được submit hay chưa và thông tin nhập vào có hợp lệ hay không
        //nếu thỏa mãn điều kiện thì render ra view show kết quả
        if ($form->isSubmitted() && $form->isValid()) {
            //render ra form output
            return $this->render(
                'note/view.html.twig',
                [
                    'note' => $note
                ]
            );
           // return $this->redirectToRoute('view_note',);
        }

        //render ra form input
        return $this->render(
            'note/add.html.twig',
            [
                'noteForm' => $form->createView()
            ]
        );
    }

    //Cách 2: tạo form bằng createForm() => recommended
    #[Route('/createnote', name: 'create_note')]
    public function createNote(Request $request) {
        $note = new Note;
        //tạo ra form từ file form type và lưu thông tin vào object
        $form = $this->createForm(NoteType::class, $note);
        //add bổ sung nút Submit trong controller
        //$form->add('Create', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->render(
                'note/view.html.twig',
                [
                    'note' => $note
                ]
            );
        }
        return $this->render(
            'note/add.html.twig',
            [
                'noteForm' => $form->createView()
            ]
        );
    }
}
