<?php

namespace App\Controller;

use App\Repository\AdventureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    #[Route('/adventure', name: 'app_adventure')]
    public function index(AdventureRepository $adventureRepository): Response
    {
        return $this->render('adventure/index.html.twig', [
            'adventure' => $adventureRepository->findOneBy([], null, 1),
        ]);
    }
}
