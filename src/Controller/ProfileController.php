<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AppAbstractController
{
    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile', name: 'app_profile')]
    public function index(#[CurrentUser] UserInterface $user): Response
    {
        return $this->render('profile/index.html.twig', [
            'adventures' => $user->adventures,
        ]);
    }

    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile/books', name: 'app_books_profile')]
    public function getUserBooks(
        BookRepository $bookRepository,
        #[CurrentUser] UserInterface $user
    ): Response {
        return $this->render('profile/books.html.twig', [
            'books' => $bookRepository->findBy(['creator' => $user])
        ]);
    }
}
