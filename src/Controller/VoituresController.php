<?php

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

        return $this->render('Public/Voitures/index.html.twig', [
            'voitures' => $voitures,
            'marques' => $marques,
            'types' => $types,
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

        return $this->render('Public/Voitures/details-voiture.html.twig', [
            'voiture' => $voiture,
            'locationForm' => $locationForm->createView(),
        ]);
    }
}
