<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function indexNoLocal(Request $request): Response
    {
        $locale = $request->getLocale();
        return $this->redirectToRoute('app_home', ['_locale' => $locale], 301);
    }

    #[Route('/{_locale<%app_locales%>}', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [

        ]);
    }
}
