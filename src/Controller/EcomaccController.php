<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EcomaccController extends AbstractController
{
    #[Route('/ecomacc', name: 'app_ecomacc')]
    public function index(): Response
    {
        return $this->render('ecomacc/index.html.twig', [
            'controller_name' => 'EcomaccController',
        ]);
    }
}
