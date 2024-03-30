<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ServiceController extends AbstractController
{
    #[Route('/{_locale<%app_locales%>}/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
        ]);
    }

    #[Route('/{_locale<%app_locales%>}/training-and-workshops', name: 'app_training_and_workshops')]
    public function trainingAndWorkshops(): Response
    {
        return $this->render('training_and_workshops/index.html.twig', [
        ]);
    }
}
