<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\AdventureSheet;
use App\Entity\Book;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdventureController extends AbstractController
{
    #[Route('/adventure/{slug}', name: 'app_adventure')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function getAdventure(
        Book $book,
        AdventureRepository $adventureRepository,
        ChapterRepository $chapterRepository
    ): Response {
        $adventure = $adventureRepository->findOneBy([
            'book' => $book,
            'player' => $this->getUser(),
        ]);

        if (!$adventure) {
            $adventure = (new Adventure())
                ->setPlayer($this->getUser())
                ->setBook($book)
                ->setAdventureSheet(
                    new AdventureSheet()
                )
                ->setChapter($chapterRepository->findFirstChapterOfBook($book));
            $adventureRepository->save($adventure, true);
        }

        return $this->render('adventure/adventure.html.twig', [
            'adventure' => $adventure,
        ]);
    }
}
