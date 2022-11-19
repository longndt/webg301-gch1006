<?php

namespace App\Controller;

use App\Entity\Laptop;
use App\Form\LaptopType;
use App\Repository\LaptopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/laptop')]
class LaptopController extends AbstractController
{
   


    #[Route('/', name: 'app_laptop_index', methods: ['GET'])]
    public function index(LaptopRepository $laptopRepository): Response
    {
        return $this->render('laptop/index.html.twig', [
            'laptops' => $laptopRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_laptop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LaptopRepository $laptopRepository): Response
    {
        $laptop = new Laptop();
     
        $form = $this->createForm(LaptopType::class, $laptop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $laptopRepository->save($laptop, true);

            return $this->redirectToRoute('app_laptop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('laptop/new.html.twig', [
            'laptop' => $laptop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laptop_show', methods: ['GET'])]
    public function show(Laptop $laptop): Response
    {
        return $this->render('laptop/show.html.twig', [
            'laptop' => $laptop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_laptop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Laptop $laptop, LaptopRepository $laptopRepository): Response
    {
        $form = $this->createForm(LaptopType::class, $laptop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $laptopRepository->save($laptop, true);

            return $this->redirectToRoute('app_laptop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('laptop/edit.html.twig', [
            'laptop' => $laptop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laptop_delete', methods: ['POST'])]
    public function delete(Request $request, Laptop $laptop, LaptopRepository $laptopRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laptop->getId(), $request->request->get('_token'))) {
            $laptopRepository->remove($laptop, true);
        }

        return $this->redirectToRoute('app_laptop_index', [], Response::HTTP_SEE_OTHER);
    }
}
