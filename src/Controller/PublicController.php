<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'app_public')]
    public function index(): Response
    {
        return $this->render('Public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    #[Route('/a-propos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('Public/apropos.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('Public/contact.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

  
}
