<?php

namespace App\Controller;

use App\Entity\Music;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyboxController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/symfonybox', name: 'app_symfonybox')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Music::class)->findAll();

        return $this->render('symfonybox/index.html.twig', [
            'musics' => $repository
        ]);
    }

    #[Route('/symfonybox/favoris', name: 'app_symfonybox_favoris')]
    public function favoris(MusicRepository $music, ManagerRegistry $doctrine)
    {
        $user = $this->getUser();
        $userId = $user->getId();

        $queryBuilder = $doctrine->getManager()->createQueryBuilder()
        ->select('m')
        ->from(Music::class, 'm')
        ->join('m.favoris', 'f')
        ->where('f.id = :userId')
        ->setParameter('userId', $userId);
        
        $favorites = $queryBuilder->getQuery()->getResult();
        
        // $repository = $doctrine->getRepository(Music::class)->findBy(['favoris'=>$user]);
        
        return $this->render('favoris/index.html.twig', [
            'favoris' => $favorites
        ]);
        
    }

    #[Route('/favoris/ajout/{id}', name: 'ajout_favoris')]
    public function ajoutFavori(Music $music, ManagerRegistry $doctrine)
    {
        $music->addFavori($this->getUser());

        $em = $doctrine->getManager();
        $em->persist($music);
        $em->flush();
        
        return $this->redirectToRoute('app_symfonybox');
    }

    #[Route('/favoris/retrait/{id}', name: 'retrait_favoris')]
    public function retraitFavori(Music $music, ManagerRegistry $doctrine)
    {
        $music->removeFavori($this->getUser());

        $em = $doctrine->getManager();
        $em->persist($music);
        $em->flush();
        
        return $this->redirectToRoute('app_symfonybox');
    }
}
