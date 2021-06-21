<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\Book;
use App\Entity\Character;
use App\Entity\Inventory;
use App\Entity\Item;
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
      'user' => $this->getUser(),
      'status' => Adventure::STATUS_IN_PROGRESS
    ]);

    return $this->json($adventure, Response::HTTP_OK, [], ['groups' => 'adventures']);
  }

  #[Route('/api/adventures', name: 'app_post_adventures', methods: ['POST'])]
  public function createGame(Request $request): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $book = $em->getRepository(Book::class)->findOneBy(['slug' => json_decode($request->getContent(), true)['book']]);
    $paragraph = $em->getRepository(Paragraph::class)->findOneBy(['number' => 1, 'book' => $book]);

    $inventory = new Inventory();
    foreach ($book->getStartingInventory()->getItems() as $startingItem) {
      $item = (new Item())
        ->setName($startingItem->getName())
        ->setQuantity($startingItem->getQuantity());

      $inventory->addItem($item);
      $item->setInventory($inventory);
    }

    $adventure = (new Adventure())
      ->setBook($book)
      ->setParagraph($paragraph)
      ->setCharacter(new Character())
      ->setUser($this->getUser())
      ->setInventory($inventory);

    $em->persist($adventure);
    $em->flush();

    return $this->json($adventure, Response::HTTP_CREATED, [], ['groups' => 'adventures']);
  }

  #[Route('/api/adventures/{id}', name: 'app_put_adventures', methods: ['PUT'])]
  public function updateGame(Request $request, Adventure $adventure): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    if (isset(json_decode($request->getContent(), true)['paragraph'])) {
      $paragraph = $em->getRepository(Paragraph::class)->findOneBy([
        'number' => json_decode($request->getContent(), true)['paragraph'],
        'book' => $adventure->getBook()
      ]);

      $adventure->setParagraph($paragraph);
    }

    if (isset(json_decode($request->getContent(), true)['status'])) {
      $adventure->setStatus(json_decode($request->getContent(), true)['status']);
    }

    $em->persist($adventure);
    $em->flush();

    return $this->json($adventure, Response::HTTP_OK, [], ['groups' => 'adventures']);
  }
}
