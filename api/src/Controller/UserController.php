<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
  #[Route('/api/users', name: 'app_get_users', methods: ['GET'])]
  public function getUsers(): JsonResponse
  {
    return $this->json($this->getUser(), Response::HTTP_OK, [], ['groups' => 'users']);
  }

  #[Route('/users', name: 'app_post_users', methods: ['POST'])]
  public function createUser(Request $request, UserPasswordEncoderInterface $userPasswordEncoder): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $username = $data['username'];
    $password = $data['password'];

    $user = (new User())
      ->setUsername($username);

    $user->setPassword($userPasswordEncoder->encodePassword($user, $password));

    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();

    return $this->json($user, Response::HTTP_CREATED, [], ['groups' => 'users']);
  }
}
