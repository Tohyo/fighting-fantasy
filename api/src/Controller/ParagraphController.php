<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Paragraph;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParagraphController extends AbstractController
{
  #[Route('/paragraphs/{number}/books/{id}', name: 'app_get_paragraphs', methods: ['GET'])]
  public function getParagraphByNumberAndBook(int $number, Book $book): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    return $this->json(
      $em->getRepository(Paragraph::class)->findOneBy(['number' => $number, 'book' => $book]),
      Response::HTTP_OK,
      [],
      ['groups' => 'paragraphs']
    );
  }
}
