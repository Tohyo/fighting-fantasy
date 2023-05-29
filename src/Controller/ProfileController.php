<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AppAbstractController
{
    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile', name: 'app_profile', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile/books', name: 'app_profile_books', methods: ['GET'])]
    public function getUserBooks(BookRepository $bookRepository, #[CurrentUser] UserInterface $user): Response {
        return $this->render('profile/_books.html.twig', [
            'books' => $bookRepository->findBy(['creator' => $user])
        ]);
    }

    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile/adventures', name: 'app_profile_adventures', methods: ['GET'])]
    public function getUserAdventures(#[CurrentUser] UserInterface $user): Response
    {
        return $this->render('profile/_adventures.html.twig', [
            'adventures' => $user->getAdventures(),
        ]);
    }
}
