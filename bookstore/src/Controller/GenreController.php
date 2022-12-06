<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/genre')]
class GenreController extends AbstractController
{ 
    #[Route('/index', name: 'genre_index')]
    public function genreIndex () {
      $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
      return $this->render('genre/index.html.twig',
          [
              'genres' => $genres
          ]);
    }

    #[Route('/list', name: 'genre_list')]
    public function genreList () {
      $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
      return $this->render('genre/list.html.twig',
          [
              'genres' => $genres
          ]);
    }
  
    #[Route('/detail/{id}', name: 'genre_detail')]
    public function genreDetail ($id, GenreRepository $genreRepository) {
      $genre = $genreRepository->find($id);
      if ($genre == null) {
          $this->addFlash('Warning', 'Invalid genre id !');
          return $this->redirectToRoute('genre_index');
      }
      return $this->render('genre/detail.html.twig',
          [
              'genre' => $genre
          ]);
    }
  
    #[IsGranted("ROLE_ADMIN")]
    #[Route('/delete/{id}', name: 'genre_delete')]
    public function genreDelete ($id, ManagerRegistry $managerRegistry) {
      $genre = $managerRegistry->getRepository(Genre::class)->find($id);
      if ($genre == null) {
          $this->addFlash('Warning', 'Genre not existed !');
      } 
      //check xem còn book trong genre hay không trước khi xóa
      else if (count($genre->getBooks()) > 0) {
        $this->addFlash('Warning', 'Can not delete this genre !');
      } 
      else {
          $manager = $managerRegistry->getManager();
          $manager->remove($genre);
          $manager->flush();
          $this->addFlash('Info', 'Delete genre successfully !');
      }
      return $this->redirectToRoute('genre_index');
    }
  
    #[Route('/add', name: 'genre_add')]
    public function genreAdd (Request $request) {
      $genre = new Genre;
      $form = $this->createForm(GenreType::class,$genre);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $manager = $this->getDoctrine()->getManager();
          $manager->persist($genre);
          $manager->flush();
          $this->addFlash('Info','Add genre successfully !');
          return $this->redirectToRoute('genre_index');
      }
      return $this->renderForm('genre/add.html.twig',
      [
          'genreForm' => $form
      ]);
    }
  
    #[Route('/edit/{id}', name: 'genre_edit')]
    public function genreEdit ($id, Request $request) {
      $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
      if ($genre == null) {
          $this->addFlash('Warning', 'Genre not existed !');
          return $this->redirectToRoute('genre_index');
      } else {
          $form = $this->createForm(GenreType::class,$genre);
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $manager = $this->getDoctrine()->getManager();
              $manager->persist($genre);
              $manager->flush();
              $this->addFlash('Info','Edit genre successfully !');
              return $this->redirectToRoute('genre_index');
          }
          return $this->renderForm('genre/edit.html.twig',
          [
              'genreForm' => $form
          ]);
      }
    }
}
