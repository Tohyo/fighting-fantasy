<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use App\Security\Voter\BookVoter;
use App\Security\Voter\ChapterVoter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ChapterController extends AppAbstractController
{
    #[Route('/chapter/list/{id}', name: 'app_chapter_list')]
    public function list(Book $book): Response
    {
        $this->denyAccessUnlessGranted(BookVoter::VIEW, $book);

        return $this->render('chapter/list.html.twig', [
            'chapters' => $book->chapters
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

        $this->denyAccessUnlessGranted(ChapterVoter::VIEW, $chapter);

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
