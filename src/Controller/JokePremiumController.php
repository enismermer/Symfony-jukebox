<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JokePremiumController extends AbstractController
{
    #[IsGranted('ROLE_PREMIUM')]
    #[Route('/joke/premium', name: 'app_joke_premium')]
    public function index(): Response
    {
        return $this->render('joke_premium/index.html.twig', [
            'controller_name' => 'JokePremiumController',
        ]);
    }
}
