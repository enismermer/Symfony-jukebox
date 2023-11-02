<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Form\RatingType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/rating', name: 'app_rating')]
    public function index(EntityManagerInterface $entityManager, SecurityBundleSecurity $security): Response
    {
        $user = $security->getUser(); // Obtenez l'utilisateur actuellement connecté

        if ($user) {
            $userEmail = $user; // Accédez à l'email de l'utilisateur
        } else {
            $userEmail = null;
        }

        $ratingRepository = $entityManager->getRepository(Rating::class); // Je prends en compte le repository 'Rating' lié à la classe Rating
        $numberOfRatings = $ratingRepository->count([]); // Je récupère le nombre d'évaluations dans ma table Rating

        $query = $ratingRepository
        ->createQueryBuilder('r')
        ->select('u.email as user_email, m.image as music_image, m.title as music_title, r.id, r.comment, r.rating, r.updated_at')
        ->leftJoin('r.user', 'u') // Effectuez une jointure avec l'entité User
        ->leftJoin('r.music', 'm') // Effectuez une jointure avec l'entité Music
        ->getQuery();

        // dd($query);

        $ratings = $query->getResult(); // Je récupère les résultats sélectionnés

        return $this->render('rating/index.html.twig', [
            'numberOfRatings' => $numberOfRatings, // Je mets en paramètre '$numberOfRatings' afin de l'afficher dans la vue
            'ratings'         => $ratings,         // Je mets en paramètre '$ratings' afin de l'afficher dans la vue
            'userEmail'       => $userEmail        // Je mets en paramètre '$userEmail' afin de l'afficher dans la vue
        ]);
    }

    #[Route('/rating-form', name: 'app_rating_form')]
    public function form(Request $request): Response
    {
        $rating = new Rating();

        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenez l'utilisateur actuellement connecté
            $user = $this->getUser();

            if ($user) {
                // Associez l'utilisateur à la notation
                $rating->setUser($user);
            
                // Définissez created_at et updated_at
                $timezone = new \DateTimeZone('Europe/Paris'); // Fuseau horaire de la France
                $dateTime = new \DateTime('now', $timezone);
                $rating->setCreatedAt($dateTime);
                $rating->setUpdatedAt($dateTime);

                // Gérer la sauvegarde du rating dans la base de données
                $this->entityManager->persist($rating);
                $this->entityManager->flush();

                // Rediriger vers la page rating/index.html.twig
                return $this->redirectToRoute('app_rating');
            }
        }

        return $this->render('rating/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/rating-form/edit/{id}', name: 'app_rating_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Vérifiez que l'utilisateur actuel est bien l'auteur de la note (vous pouvez implémenter une logique de sécurité ici)
        $user = $this->getUser();
        $rating = $entityManager->getRepository(Rating::class)->find($id);
        
        if ($user->getId() !== $rating->getUser()->getId()) {
            throw $this->createAccessDeniedException('Vous n\'avez pas la permission de modifier cette note.');
        }

        // Créez un formulaire pour la modification de la note
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Mettez à jour updated_at à la date actuelle
            $timezone = new \DateTimeZone('Europe/Paris'); // Fuseau horaire de la France
            $dateTime = new \DateTime('now', $timezone);
            $rating->setUpdatedAt($dateTime);

            // Sauvegardez la modification en base de données
            $this->entityManager->persist($rating);
            $this->entityManager->flush();

            // Redirigez l'utilisateur vers la page de confirmation ou une autre page appropriée
            return $this->redirectToRoute('app_rating', ['id' => $rating->getId()]);
        }   

        return $this->render('rating/form.html.twig', [
            'form' => $form->createView(),
            'rating' => $rating,
        ]);
    }

    #[Route('/rating/delete/{id}', name: 'app_rating_delete')]
    public function deleteRating(Rating $rating, EntityManagerInterface $entityManager): Response
    {
        // Ajoutez la logique de suppression de l'évaluation ici
        $entityManager->remove($rating);
        $entityManager->flush();

        return $this->redirectToRoute('app_rating'); // Redirigez vers la liste des évaluations après la suppression
    }
}
