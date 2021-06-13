<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\Book;
use App\Entity\Character;
use App\Entity\Paragraph;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
  #[Route('/api/adventures/{slug}', name: 'app_get_adventures', methods: ['GET'])]
  public function getAdventure(string $slug): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $adventure = $em->getRepository(Adventure::class)->findOneBy([
      'book' => $em->getRepository(Book::class)->findOneBy(['slug' => $slug]),
      'user' => $this->getUser()
    ]);

    return $this->json($adventure, Response::HTTP_CREATED, [], ['groups' => 'adventures']);
  }

  #[Route('/api/adventures', name: 'app_post_adventures', methods: ['POST'])]
  public function createGame(Request $request): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $book = $em->getRepository(Book::class)->findOneBy(['slug' => json_decode($request->getContent(), true)['book']]);
    $paragraph = $em->getRepository(Paragraph::class)->findOneBy(['number' => 1, 'book' => $book]);

    $adventure = (new Adventure())
      ->setBook($book)
      ->setParagraph($paragraph)
      ->setCharacter(new Character())
      ->setUser($this->getUser());

    $em->persist($adventure);
    $em->flush();

    return $this->json($adventure, Response::HTTP_CREATED, [], ['groups' => 'adventures']);
  }

  #[Route('/api/adventures/{id}', name: 'app_put_adventures', methods: ['PUT'])]
  public function updateGame(Request $request, Adventure $adventure): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $paragraph = $em->getRepository(Paragraph::class)->findOneBy([
      'number' => $request->request->get('paragraph'),
      'book' => $adventure->getBook()
    ]);

    $adventure->setParagraph($paragraph);

    $em->persist($adventure);
    $em->flush();

    return $this->json($adventure, Response::HTTP_OK, [], ['groups' => 'adventures']);
  }
}
