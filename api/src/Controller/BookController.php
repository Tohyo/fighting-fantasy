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
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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

  #[Route('/api/books', name: 'app_post_books', methods: ['POST'])]
  public function createBooks(Request $request, SerializerInterface $serializer): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();
    $book = $serializer->deserialize($request->getContent(), Book::class, 'json');

    $em->persist($book);
    $em->flush();

    return $this->json($book, Response::HTTP_CREATED, [], ['groups' => 'books']);
  }

  #[Route('/books/{slug}/paragraphs', name: 'app_get_book_paragraphs', methods: ['GET'])]
  public function getParagraphsByBook(Book $book): JsonResponse
  {
    return $this->json($book, Response::HTTP_OK, [], ['groups' => 'all_paragraphs']);
  }
}
