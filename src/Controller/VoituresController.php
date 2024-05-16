<?php

namespace App\Controller;


use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class VoituresController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function index(Request $request, VoitureRepository $voitureRepository): Response
    {
        $marque = $request->query->get('marque');
        $type = $request->query->get('type');

        $criteria = [];
        if ($marque) {
            $criteria['marque'] = $marque;
        }
        if ($type) {
            $criteria['type'] = $type;
        }

        $voitures = $voitureRepository->findBy($criteria);

        // Récupérer toutes les marques et types pour le filtre
        $marques = $voitureRepository->findAllMarques();
        $types = $voitureRepository->findAllTypes();

        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
            'marques' => $marques,
            'types' => $types,
        ]);
    }
}



