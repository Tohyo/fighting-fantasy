<?php

namespace App\Controller;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
  #[Route('/api/items/{id}', name: 'app_put_items', methods: ['PUT'])]
  public function updateGame(Request $request, Item $item): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();

    $item->setQuantity(json_decode($request->getContent(), true)['quantity']);

    $em->persist($item);
    $em->flush();

    return $this->json($item, Response::HTTP_OK, [], ['groups' => 'adventures']);
  }
}
