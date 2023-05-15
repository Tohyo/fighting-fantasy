<?php

namespace App\Controller;

use App\Factory\AdventureFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    #[Route('/adventure', name: 'app_adventure')]
    public function index(): Response
    {
        $adventure = AdventureFactory::last();
        
        return $this->render('adventure/index.html.twig', [
            'adventure' => $adventure,
        ]);
    }
}
