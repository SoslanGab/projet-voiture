<?php

namespace App\Controller\Admin;
use App\Entity\Client;
use App\Entity\Voiture;
use App\Entity\TypeVoiture;
use App\Entity\Locations;
use App\Entity\ImageVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('Admin/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Votre Projet Voiture');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Clients', 'fas fa-user', Client::class);
        yield MenuItem::linkToCrud('Voitures', 'fas fa-car', Voiture::class);
        yield MenuItem::linkToCrud('Type de voitures', 'fas fa-car-on', TypeVoiture::class);
        yield MenuItem::linkToCrud('Locations', 'fas fa-euro', Locations::class);
    }
}

