<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BookController extends AbstractController
{
  #[Route('/books', name: 'app_get_books', methods: ['GET'])]
  public function getBooks(): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    return $this->json($em->getRepository(Book::class)->findAll(), Response::HTTP_OK, [], ['groups' => 'books']);
  }

  #[IsGranted(User::ROLE_ADMIN)]
  #[Route('/api/books/{id}', name: 'app_put_books', methods: ['PUT'])]
  public function updateBooks(Book $book, Request $request): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $data = json_decode($request->getContent(), true);

    if (isset($data['title'])) {
      $book->setTitle($data['title']);
    }

    $em->flush();

    return $this->json($book, Response::HTTP_OK, [], ['groups' => 'books']);
  }

  #[Route('/books/{slug}', name: 'app_get_books_by_slug', methods: ['GET'])]
  public function getBooksBySlug(Book $book): JsonResponse
  {
    return $this->json($book, Response::HTTP_OK, [], ['groups' => 'books']);
  }
}
