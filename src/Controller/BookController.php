<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AppAbstractController
{
    #[Route('/book/{slug}', name: 'app_book')]
    public function getBook(Book $book): Response
    {
        return $this->render('book/book.html.twig', [
            'book' => $book,
        ]);
    }
}
