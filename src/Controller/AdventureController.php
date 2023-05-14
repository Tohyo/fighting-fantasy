<?php

namespace App\Controller;

use App\Factory\AdventureSheetFactory;
use App\Factory\ChapterFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    #[Route('/adventure', name: 'app_adventure')]
    public function index(): Response
    {
        return $this->render('adventure/index.html.twig', [
            'adventure_sheet' => AdventureSheetFactory::last(),
            'chapter' => ChapterFactory::last(),
        ]);
    }
}
