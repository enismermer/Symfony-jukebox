<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FolioController extends AbstractController
{
    #[Route('/folio', name: 'app_folio')]
    public function index(): Response
    {
        return $this->render('folio/index.html.twig', [
            'controller_name' => 'FolioController',
        ]);
    }
}
