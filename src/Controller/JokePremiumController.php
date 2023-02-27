<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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

class SymfonyDocs
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchGitHubInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://chuckn.neant.be/api/joke/{id}'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 706, 'name' => 'symfony-docs', ...]

        return $content;
    }
}