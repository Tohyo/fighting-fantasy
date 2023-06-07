<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\AdventureSheet;
use App\Entity\Book;
use App\Enum\AdventureStatusEnum;
use App\Repository\AdventureRepository;
use App\Repository\ChapterRepository;
use App\Security\Voter\AdventureVoter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdventureController extends AppAbstractController
{
    #[Route('/adventure/{slug}', name: 'app_adventure', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function getAdventure(
        Book $book,
        AdventureRepository $adventureRepository,
        ChapterRepository $chapterRepository,
        #[CurrentUser] UserInterface $user
    ): Response {
        $adventure = $adventureRepository->findOneBy([
            'book' => $book,
            'player' => $user,
        ]);

        if (!$adventure) {
            $adventure = new Adventure();
            $adventure->player = $user;
            $adventure->book = $book;
            $adventure->adventureSheet = new AdventureSheet();
            $adventure->chapter = $chapterRepository->findFirstChapterOfBook($book);
            $adventureRepository->save($adventure, true);
        }

        return $this->render('adventure/adventure.html.twig', [
            'adventure' => $adventure,
        ]);
    }

    #[Route('/adventure/{id}/resign', name: 'app_adventure_resign', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function resignFromAdventure(Adventure $adventure, AdventureRepository $adventureRepository): Response
    {
        $this->denyAccessUnlessGranted(AdventureVoter::RESIGN, $adventure);

        $adventure->status = AdventureStatusEnum::ABANDONED->value;
        $adventureRepository->save($adventure, true);

        return $this->redirectToRoute('app_home');
    }
}
