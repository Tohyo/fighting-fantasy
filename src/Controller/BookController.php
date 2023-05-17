<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/books', name: 'app_books')]
    public function getList(BookRepository $bookRepository): Response
    {
        return $this->render('book/list.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/book/{slug}', name: 'app_book')]
    public function getBook(Book $book): Response
    {
        return $this->render('book/index.html.twig', [
            'book' => $book,
        ]);
    }
}
