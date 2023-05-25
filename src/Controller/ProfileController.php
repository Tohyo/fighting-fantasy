<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AppAbstractController
{
    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'adventures' => $this->getUser()->getAdventures(),
        ]);
    }
}
