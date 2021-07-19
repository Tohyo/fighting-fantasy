<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Paragraph;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
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

  #[Route('/api/paragraphs', name: 'app_post_paragraphs', methods: ['POST'])]
  public function createParagraph(Request $request, DenormalizerInterface $denormalizer): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $paragraph = $denormalizer->denormalize(json_decode($request->getContent(), true), Paragraph::class, 'json');

    $em->persist($paragraph);
    $em->flush();

    return $this->json($paragraph, Response::HTTP_CREATED, [], ['groups' => 'paragraphs']);
  }
}
