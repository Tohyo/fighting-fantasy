<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
  #[Route('/api/users', name: 'app_get_users', methods: ['GET'])]
  public function getAdventure(): JsonResponse
  {
    return $this->json($this->getUser(), Response::HTTP_OK, [], ['groups' => 'users']);
  }
}
