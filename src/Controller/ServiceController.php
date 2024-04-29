<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{

     /**
	 * @Route("/{_locale<%app.supported_locales%>}/service", name="app_services",  options={"sitemap" = true}, priority=1)
	 */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'clients' => $clientRepository->findAll()
        ]);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/training-and-workshops", name="app_training_and_workshops",  options={"sitemap" = true}, priority=1)
     */
    public function trainingAndWorkshops(ClientRepository $clientRepository): Response
    {
        return $this->render('training_and_workshops/index.html.twig', [
            'clients' => $clientRepository->findAll()
        ]);
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/consulting-and-coaching", name="app_consulting_and_coaching",  options={"sitemap" = true}, priority=1)
     */
    public function consultingAndCoaching(ClientRepository $clientRepository): Response
    {
        return $this->render('consulting_and_coaching/index.html.twig', [
            'clients' => $clientRepository->findAll()
        ]);
    }
}
