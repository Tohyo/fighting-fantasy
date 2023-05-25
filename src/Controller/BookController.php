<?php

namespace App\Controller;

use App\Entity\Book;
use App\Security\Voter\BookVoter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AppAbstractController
{
    #[Route('/book/{id}', requirements: ['id' => '\d+'], name: 'app_book_edit')]
    public function edit(Book $book): Response
    {
        $this->denyAccessUnlessGranted(BookVoter::EDIT, $book);

        return $this->render('book/edit.html.twig', [
            'book' => $book
        ]);
    }

    #[Route('/book/{slug}', name: 'app_book')]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

}
