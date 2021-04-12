<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
  #[Route('/books', name: 'app_get_books', methods: ['GET'])]
  public function getBooks(): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    return $this->json($em->getRepository(Book::class)->findAll(), Response::HTTP_OK, [], ['groups' => 'books']);
  }

  #[Route('/books/{slug}', name: 'app_get_books_by_slug', methods: ['GET'])]
  public function getBooksBySlug(Book $book): JsonResponse
  {
    return $this->json($book, Response::HTTP_OK, [], ['groups' => 'books']);
  }
}
