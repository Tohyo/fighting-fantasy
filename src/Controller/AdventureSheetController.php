<?php

namespace App\Controller;

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
            'adventure_sheet' => AdventureSheetFactory::createOne(),
        ]);
    }
}
