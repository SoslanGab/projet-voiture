<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupère l'erreur d'authentification si elle existe
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Récupère le dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
        ]);        
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \LogicException('Cette méthode peut être vide. Elle sera interceptée par la configuration du firewall.');
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(): Response
    {
        return $this->render('security/inscription.html.twig');
    }

    #[Route('/inscription/submit', name: 'app_inscription_submit', methods: ['POST'])]
    public function submit(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response {
        $client = new Client();
       
        $password = $passwordHasher->hashPassword($client, $request->request->get('password'));
        $client->setPassword($password);
        
        // Enregistrement
        $entityManager->persist($client);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_login');
    }
}
