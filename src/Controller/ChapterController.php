<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Chapter;
use App\Form\ChapterType;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use App\Security\Voter\BookVoter;
use App\Security\Voter\ChapterVoter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ChapterController extends AppAbstractController
{
    #[Route('/chapter/create/{id}', name: 'app_chapter_create')]
    public function create(
        Request $request,
        Book $book,
        ChapterRepository $chapterRepository
    ): Response {
        $chapter = new Chapter();
        $chapter->book = $book;

        $this->denyAccessUnlessGranted(ChapterVoter::CREATE, $chapter);

        $form = $this->createForm(ChapterType::class, $chapter);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chapterRepository->save($chapter, true);

            return $this->redirectToRoute('app_chapter_show', [
                'id' => $chapter->id
            ]);
        }

        return $this->render('chapter/create.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
        ]);
    }

    #[Route('/chapter/edit/{id}', name: 'app_chapter_edit')]
    public function edit(
        Request $request,
        Chapter $chapter,
        ChapterRepository $chapterRepository
    ): Response {
        $this->denyAccessUnlessGranted(ChapterVoter::EDIT, $chapter);

        $form = $this->createForm(ChapterType::class, $chapter);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $chapterRepository->save($chapter, true);

            return $this->redirectToRoute('app_chapter_show', [
                'id' => $chapter->id
            ]);
        }

        return $this->render('chapter/edit.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
        ]);
    }

    #[Route('/chapter/{id}', name: 'app_chapter_show', methods: ['GET'])]
    public function show(Chapter $chapter): Response
    {
        $this->denyAccessUnlessGranted(ChapterVoter::VIEW, $chapter);

        return $this->render('chapter/show.html.twig', [
            'chapter' => $chapter,
        ]);
    }

    #[Route('/chapter/{id}', name: 'app_chapter_delete', methods: ['DELETE'])]
    public function delete(Chapter $chapter, ChapterRepository $chapterRepository): Response
    {
        $this->denyAccessUnlessGranted(ChapterVoter::DELETE, $chapter);

        $chapterRepository->remove($chapter, true);

        return $this->redirectToRoute('app_chapter_list', [
            'id' => $chapter->book->id,
        ]);
    }

    #[Route('/chapter/list/{id}', name: 'app_chapter_list')]
    public function list(Book $book): Response
    {
        $this->denyAccessUnlessGranted(BookVoter::VIEW, $book);

        return $this->render('chapter/list.html.twig', [
            'chapters' => $book->chapters,
            'book' => $book,
        ]);
    }

    #[Route('/chapter/{slug}/{number}', name: 'app_chapter')]
    public function getChapter(
        Book $book,
        int $number,
        AdventureRepository $adventureRepository,
        ChapterRepository $chapterRepository,
        #[CurrentUser] UserInterface $user
    ): Response|NotFoundHttpException {
        $chapter = $chapterRepository->findOneBy([
            'book' => $book,
            'number' => $number,
        ]);

        if (!$chapter) {
            return $this->createNotFoundException();
        }

        $this->denyAccessUnlessGranted(ChapterVoter::ADVENTURE, $chapter);

        $adventure = $adventureRepository->findOneBy([
            'player' => $user,
            'book' => $chapter->book,
        ]);
        $adventure->chapter = $chapter;

        $adventureRepository->save($adventure, true);

        return $this->render('chapter/chapter.html.twig', [
            'chapter' => $chapter,
        ]);
    }
}
