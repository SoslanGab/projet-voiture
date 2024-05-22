<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Locations;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\LocationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
class ClientController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, LocationsRepository $locationsRepository): Response
    {
        /** @var Client $client */
        $client = $this->getUser();
        $form = $this->createForm(ClientType::class, $client);
        $locationsCount = $locationsRepository->count(['client' => $client]);
        $currentLocations = $locationsRepository->findBy(['client' => $client]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        // Dire Bonjour ou Bonsoir selon le fuseau horaire
        $heure = date('H');
        $salutation = ($heure < 18) ? 'Bonjour' : 'Bonsoir';

        // Récupérer les dates de location existantes pour désactiver les dates
        $existingDates = $entityManager->getRepository(Locations::class)->createQueryBuilder('l')
            ->select('l.date_de_debut, l.date_de_fin')
            ->where('l.client = :client')
            ->setParameter('client', $client)
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

        return $this->render('Public/profile.html.twig', [
            'salutation' => $salutation,
            'client' => $client,
            'currentLocations' => $currentLocations,
            'locationsCount' => $locationsCount,
            'form' => $form->createView(),
            'disabledDates' => $disabledDates,
        ]);
    }

    // #[Route('/client/{id}', name: 'app_client_delete', methods: ['POST'])]
    // public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->getPayload()->get('_token'))) {
    //         $entityManager->remove($client);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    // }
}
