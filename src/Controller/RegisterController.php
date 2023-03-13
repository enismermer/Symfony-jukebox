<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    
    #[Route("/register", name: "app_register")]
      
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $entityManager = $doctrine->getManager();
        // ici j'instancie ma class User
        $user = new User();

        // on instancie le formulaire avec la méthode creatform =>
        // avec : les paramètres de la class user.
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            $plaintextPassword = $user->getPassword();
            
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // on modifie la route de la redirection (on prend le NAME de la page)
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            // ici je rajoute à ma vue ma variable form.
            'form' => $form -> createView(),
        ]);
    }
}
