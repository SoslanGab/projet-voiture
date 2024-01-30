<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class VoituresController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function index()
    {
        return $this->render('Public/Voitures/index.html.twig');
    }
}



