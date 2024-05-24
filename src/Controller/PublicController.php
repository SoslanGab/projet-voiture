<?php

namespace App\Controller;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'app_public')]
    public function index(VoitureRepository $voitureRepository): Response
    {
        // Récupérer les 3 voitures les plus louées
        $voitures = $voitureRepository->findMostRented(3);
        return $this->render('Public/index.html.twig', [
            'controller_name' => 'PublicController',
            'voitures' => $voitures,
        ]);
    }

    #[Route('/a-propos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('Public/apropos.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    

  
}
