<?php

namespace App\Controller;

use App\Entity\Music;
use App\Form\SongSearchFormType;
use App\Repository\MusicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyboxController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_symfonybox')]
    public function index(Request $request, MusicRepository $musicRepository, SecurityBundleSecurity $security, EntityManagerInterface $entityManager): Response
    {
        
        // Récupérez toutes les chansons
        $musicRepository = $entityManager->getRepository(Music::class);
        $musics = $musicRepository->findAll();
        
        // Initialisez un tableau pour stocker les moyennes
        $averages = [];
        
        // Pour chaque chanson, calculez la moyenne des étoiles
        foreach ($musics as $music) {
            $musicId = $music->getId();
            $query = $entityManager->createQueryBuilder()
                ->select('AVG(r.rating) as average_rating')
                ->from('App:Rating', 'r')
                ->where('r.music = :musicId')
                ->setParameter('musicId', $musicId)
                ->getQuery();

            $average = $query->getSingleScalarResult();
            $averages[$musicId] = $average;
        }


        $user = $security->getUser(); // Obtenez l'utilisateur actuellement connecté
    
        if ($user) {
            $userEmail = $user->getEmail(); // Accédez à l'email de l'utilisateur
        } else {
            $userEmail = null;
        }
    
        $form = $this->createForm(SongSearchFormType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('title')->getData();
            $musics = $musicRepository->findByTitle($searchTerm); // Ajoutez cette méthode à votre MusicRepository
    
            return $this->render('symfonybox/index.html.twig', [
                'musics' => $musics,
                'form' => $form->createView(),
                'userEmail' => $userEmail,
                'averages' => $averages
            ]);
        }
        
        return $this->render('symfonybox/index.html.twig', [
            'musics' => $musics,
            'form' => $form->createView(),
            'userEmail' => $userEmail,
            'averages' => $averages
        ]);
    }

    #[Route('/favoris', name: 'app_symfonybox_favoris')]
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
