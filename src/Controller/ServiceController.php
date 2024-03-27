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
}
