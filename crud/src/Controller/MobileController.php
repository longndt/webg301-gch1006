<?php

namespace App\Controller;

use App\Entity\Mobile;
use App\Form\MobileType;
use App\Repository\MobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mobile')]
class MobileController extends AbstractController
{
    #[Route('/', name: 'app_mobile_index', methods: ['GET'])]
    public function index(MobileRepository $mobileRepository): Response
    {
        return $this->render('mobile/index.html.twig', [
            'mobiles' => $mobileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mobile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MobileRepository $mobileRepository): Response
    {
        $mobile = new Mobile();
        $form = $this->createForm(MobileType::class, $mobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mobileRepository->save($mobile, true);

            return $this->redirectToRoute('app_mobile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mobile/new.html.twig', [
            'mobile' => $mobile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_show', methods: ['GET'])]
    public function show(Mobile $mobile): Response
    {
        return $this->render('mobile/show.html.twig', [
            'mobile' => $mobile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mobile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mobile $mobile, MobileRepository $mobileRepository): Response
    {
        $form = $this->createForm(MobileType::class, $mobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mobileRepository->save($mobile, true);

            return $this->redirectToRoute('app_mobile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mobile/edit.html.twig', [
            'mobile' => $mobile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_delete', methods: ['POST'])]
    public function delete(Request $request, Mobile $mobile, MobileRepository $mobileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mobile->getId(), $request->request->get('_token'))) {
            $mobileRepository->remove($mobile, true);
        }

        return $this->redirectToRoute('app_mobile_index', [], Response::HTTP_SEE_OTHER);
    }
}
