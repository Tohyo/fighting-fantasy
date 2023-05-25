<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AppAbstractController
{
    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'adventures' => $this->getUser()->getAdventures(),
        ]);
    }

    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile/books', name: 'app_books_profile')]
    public function getUserBooks(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findBy(['creator' => $this->getUser()]);

        return $this->render('profile/books.html.twig', [
            'books' => $books
        ]);
    }
}
