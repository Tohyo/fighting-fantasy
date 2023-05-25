<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Security\Voter\BookVoter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BookController extends AppAbstractController
{
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    #[Route('/book/create')]
    public function create(Request $request, BookRepository $bookRepository): Response
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book->setCreator($this->getUser());
            $bookRepository->save($book, true);

            return $this->redirectToRoute('app_book', ['slug' => $book->getSlug()]);
        }

        return $this->render('book/create.html.twig', [
            'book' => $book,
            'form' => $form
        ]);
    }

    #[Route('/book/edit/{id}',  name: 'app_book_edit')]
    public function edit(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        $this->denyAccessUnlessGranted(BookVoter::EDIT, $book);

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->save($book, true);

            return $this->redirectToRoute('app_book', ['slug' => $book->getSlug()]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form
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
