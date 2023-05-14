<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Factory\ChapterFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChapterController extends AbstractController
{
    #[Route('/chapter', name: 'app_chapter')]
    public function index(): Response
    {
        return $this->render('chapter/index.html.twig', [
            'controller_name' => 'ChapterController',
        ]);
    }

    #[Route('/chapter/{id}', name: 'app_get_chapter')]
    public function getChapter(Chapter $chapter): Response
    {
        return $this->render('chapter/chapter.html.twig', [
            'chapter' => $chapter,
        ]);
    }
}
