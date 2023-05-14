<?php

namespace App\Controller;

use App\Entity\AdventureSheet;
use App\Factory\AdventureSheetFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureSheetController extends AbstractController
{
    #[Route('/adventure/sheet', name: 'app_adventure_sheet')]
    public function index(): Response
    {
        return $this->render('adventure_sheet/index.html.twig', [
            'controller_name' => 'AdventureSheetController',
            'adventure_sheet' => AdventureSheetFactory::last(),
        ]);
    }

    #[Route('/adventure/sheet/{id}', name: 'app_get_adventure_sheet')]
    public function getAdventureSheet(AdventureSheet $adventureSheet): Response
    {
        return $this->render('adventure_sheet/adventure_sheet.html.twig', [
            'adventure_sheet' => $adventureSheet,
        ]);
    }
}
