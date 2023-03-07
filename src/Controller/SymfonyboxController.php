<?php

namespace App\Controller;

use App\Entity\Music;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyboxController extends AbstractController
{
    #[Route('/symfonybox', name: 'app_symfonybox')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Music::class)->findAll();

        return $this->render('symfonybox/index.html.twig', [
            'musics' => $repository
        ]);
    }
}
