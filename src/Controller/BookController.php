<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Security\Voter\BookVoter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BookController extends AppAbstractController
{
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    #[Route('/book/create', name: 'app_book_create', methods: ['GET', 'POST'])]
    public function create(
        Request $request,
        BookRepository $bookRepository,
        #[CurrentUser] UserInterface $user
    ): Response {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $book->creator = $user;
            $bookRepository->save($book, true);

            return $this->redirectToRoute('app_book_show', ['slug' => $book->slug]);
        }

        return $this->render('book/create.html.twig', [
            'book' => $book,
            'form' => $form
        ]);
    }

    #[Route('/book/edit/{id}',  name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        $this->denyAccessUnlessGranted(BookVoter::EDIT, $book);

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->save($book, true);

            return $this->redirectToRoute('app_book_show', ['slug' => $book->slug]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form
        ]);
    }

    #[Route('/book/list', name: 'app_book_list', methods: ['GET'])]
    public function list(
        BookRepository $bookRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $pagination = $paginator->paginate(
            $bookRepository->findBooksQueryBuilder(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('book/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/book/{slug}', name: 'app_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }
}
