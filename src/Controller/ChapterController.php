<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use App\Security\Voter\ChapterVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChapterController extends AbstractController
{
    #[Route('/chapter/{slug}/{number}', name: 'app_chapter')]
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

        $this->denyAccessUnlessGranted(ChapterVoter::VIEW, $chapter);

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
