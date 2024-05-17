<?php

namespace App\Controller;


use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypevoitureRepository;


class VoituresController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function index(Request $request, VoitureRepository $voitureRepository,TypevoitureRepository $typevoitureRepository ): Response
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
        $marques = $voitureRepository->findAllMarques();
       

        $types = $typevoitureRepository->findAll();
        // dd($types);
        return $this->render('Public/Voitures/index.html.twig', [
            'voitures' => $voitures,
            'marques' => $marques,
            'types' => $types,
        ]);
    }
    #[Route('/voitures/{id}', name: 'app_details')]
    public function details(int $id, VoitureRepository $voitureRepository): Response
    {
        $voiture = $voitureRepository->find($id);

        if (!$voiture) {
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }

        return $this->render('Public/Voitures/details-voiture.html.twig', [
            'voiture' => $voiture,
        ]);
    }
    
}



