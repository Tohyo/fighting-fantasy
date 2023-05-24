<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Repository\AdventureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ChapterController extends AbstractController
{
    #[Route('/chapter/{id}', name: 'app_chapter')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function getChapter(
        Chapter $chapter,
        AdventureRepository $adventureRepository,
    ): Response {
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
