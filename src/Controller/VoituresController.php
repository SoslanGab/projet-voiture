<?php

// src/Controller/VoituresController.php

namespace App\Controller;

use App\Entity\Voiture;
use App\Entity\Locations;
use App\Form\LocationType;
use App\Repository\VoitureRepository;
use App\Repository\TypevoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoituresController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function index(Request $request, VoitureRepository $voitureRepository, TypevoitureRepository $typevoitureRepository): Response
    {
        $marque = $request->query->get('marque');
        $type = $request->query->get('type');
        $couleur = $request->query->get('couleur');

        $criteria = [];
        if ($marque) {
            $criteria['marque'] = $marque;
        }
        if ($type) {
            $criteria['type'] = $type;
        }
        if ($couleur) {
            $criteria['couleur'] = $couleur;
        }

        $voitures = $voitureRepository->findBy($criteria);
        $marques = $voitureRepository->findAllMarques();
        $types = $typevoitureRepository->findAll();
        $couleurs = $voitureRepository->findAllCouleurs();

        return $this->render('Public/Voitures/index.html.twig', [
            'voitures' => $voitures,
            'marques' => $marques,
            'types' => $types,
            'couleurs' => $couleurs,
        ]);
    }

    #[Route('/voitures/{id}', name: 'app_details')]
    public function details(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        $location = new Locations();
        $locationForm = $this->createForm(LocationType::class, $location);
        $locationForm->handleRequest($request);
    
        if ($locationForm->isSubmitted() && $locationForm->isValid()) {
            $location->setVoiture($voiture);
            $location->setClient($this->getUser());
    
            $dateDebut = $locationForm->get('date_de_debut')->getData();
            $dateFin = $locationForm->get('date_de_fin')->getData();
    
            // Vérifiez la disponibilité
            $existingLocations = $entityManager->getRepository(Locations::class)->createQueryBuilder('l')
                ->where('l.voiture = :voiture')
                ->andWhere('l.date_de_debut <= :dateFin AND l.date_de_fin >= :dateDebut')
                ->setParameter('voiture', $voiture)
                ->setParameter('dateDebut', $dateDebut)
                ->setParameter('dateFin', $dateFin)
                ->getQuery()
                ->getResult();
    
            if (count($existingLocations) > 0) {
                $this->addFlash('error', 'Cette voiture est déjà louée pour les dates sélectionnées.');
            } else {
                $totalPaiement = $voiture->getPrixParJour() * $dateDebut->diff($dateFin)->days;
                $location->setTotalPaiement($totalPaiement);
                $entityManager->persist($location);
                $entityManager->flush();
                $this->addFlash('success', 'La voiture a été louée avec succès.');
                return $this->redirectToRoute('app_details', ['id' => $voiture->getId()]);
            }
        }
    
        // Récupérer les dates de location existantes pour désactiver les dates
        $existingDates = $entityManager->getRepository(Locations::class)->createQueryBuilder('l')
            ->select('l.date_de_debut, l.date_de_fin')
            ->where('l.voiture = :voiture')
            ->setParameter('voiture', $voiture)
            ->getQuery()
            ->getResult();
    
        $disabledDates = [];
        foreach ($existingDates as $dateRange) {
            $start = $dateRange['date_de_debut']->format('Y-m-d');
            $end = $dateRange['date_de_fin']->format('Y-m-d');
            $current = strtotime($start);
            $last = strtotime($end);
    
            while ($current <= $last) {
                $disabledDates[] = date('Y-m-d', $current);
                $current = strtotime('+1 day', $current);
            }
        }
    
        return $this->render('Public/Voitures/details-voiture.html.twig', [
            'voiture' => $voiture,
            'locationForm' => $locationForm->createView(),
            'disabledDates' => $disabledDates,
        ]);
    }
    
}

