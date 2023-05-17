<?php

namespace App\Controller;

use App\Repository\AdventureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    #[Route('/adventure', name: 'app_adventure')]
    public function getAdventure(AdventureRepository $adventureRepository): Response
    {
        return $this->render('adventure/adventure.html.twig', [
            'adventure' => $adventureRepository->findOneBy([], null, 1),
        ]);
    }
}
