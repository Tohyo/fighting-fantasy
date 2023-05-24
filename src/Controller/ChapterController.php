<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ChapterController extends AbstractController
{
    #[Route('/chapter/{slug}/{number}', name: 'app_chapter')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function getChapter(
        Book $book,
        int $number,
        AdventureRepository $adventureRepository,
        ChapterRepository $chapterRepository
    ): Response {
        $chapter = $chapterRepository->findOneBy([
            'book' => $book,
            'number' => $number,
        ]);

        $adventure = $adventureRepository->findOneBy([
            'player' => $this->getUser(),
            'book' => $chapter->getBook(),
        ])->setChapter($chapter);
        $adventureRepository->save($adventure, true);

        return $this->render('chapter/chapter.html.twig', [
            'chapter' => $chapter,
        ]);
    }
}
