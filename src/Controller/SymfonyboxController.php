<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyboxController extends AbstractController
{
    #[Route('/symfonybox', name: 'app_symfonybox')]
    public function index(): Response
    {
        return $this->render('symfonybox/index.html.twig', [
            'controller_name' => 'SymfonyboxController',
        ]);
    }
}
