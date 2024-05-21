<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EssayController extends AbstractController
{
    #[Route('/essay', name: 'app_essay')]
    public function index(): Response
    {
        return $this->render('essay/index.html.twig', [
            'controller_name' => 'EssayController',
        ]);
    }
}
