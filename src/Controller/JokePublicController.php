<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JokePublicController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/joke/public', name: 'app_joke_public')]
    public function index(): Response
    {
        return $this->render('joke_public/index.html.twig', [
            'controller_name' => 'JokePublicController',
        ]);
    }
}
