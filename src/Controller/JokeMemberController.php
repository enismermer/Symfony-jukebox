<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JokeMemberController extends AbstractController
{
    #[IsGranted('ROLE_MEMBER')]
    #[Route('/joke/member', name: 'app_joke_member')]
    public function index(): Response
    {
        return $this->render('joke_member/index.html.twig', [
            'controller_name' => 'JokeMemberController',
        ]);
    }
}
