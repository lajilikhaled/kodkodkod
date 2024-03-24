<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Traits\EntityManagerTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
	use EntityManagerTrait;

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

    #[Route('/{_locale<%app_locales%>}/portfolio', name: 'app_portfolio')]
    public function portfolio(
        Request $request,
        ProjectRepository $projectRepository,
        CategoryRepository $categoryRepository,
        EntityManagerInterface $em
        )
    {
        // $project = new Project();
        // $project->setCategory($categoryRepository->find(1));
        // $project->setTitle('Canal+');
        // $project->setImage('build/images/projects/moa-screen.png');
        // $project->setDescription("Création d'un Livret accueil et d'un BO de gestion de contenu");
        // $project->setDescriptionEn("Création d'un Livret accueil et d'un BO de gestion de contenu");
        // $project->setDescriptionKo("Création d'un Livret accueil et d'un BO de gestion de contenu");
        // $technologies = [];
        // $technologies[] = 'Nuxt.js';
        // $technologies[] = 'Kotlin';
        // $project->setTechnology($technologies);
        // $ecommerces = [];
        // $ecommerces[] = 'WooCommerce';
        // $project->setEcommerce($ecommerces);
        // $blockchains = [];
        // $blockchains[] = 'NFT Metaverse';
        // $blockchains[] = 'Polygon';
        // $project->setBlockchain($blockchains);
        // $em->persist($project);
        // $em->flush();
        // dd($project);


	    $projects = $projectRepository->findAllOrderedByPriority($request -> getLocale());

	    $categories = $categoryRepository->findAll();
		$categoriesWithTechnos = [];

		foreach ($categories as $cat) {
			$nbProjects = count($cat->getProjects());
			$listTechnologies = [];
			foreach ($cat->getProjects() as $project ) {
				foreach($project->getTechnology() as $techno){

					$techno = ucfirst(strtolower($techno));

					if (!in_array($techno, $listTechnologies)) {
						array_push($listTechnologies, $techno);
					}
				}
			}
			$nbProjectByTechno = [];
			foreach ($listTechnologies as $techno ) {
				$nbProj = 0;
				foreach ($cat->getProjects() as $project) {
					foreach ($project->getTechnology() as $technoProject) {
						if (ucfirst(strtolower($technoProject)) == ucfirst(strtolower($techno))) {
							$nbProj = $nbProj + 1;
						}
					}
				}
				$objectTmp = (object) ["techno" => ucfirst(strtolower($techno)), "nbProjects" => $nbProj];
				array_push($nbProjectByTechno, $objectTmp);
			}

			$object = (object) ["cat" => $cat, "nbProjects" => $nbProjects, "technologies" => $nbProjectByTechno];
			array_push($categoriesWithTechnos, $object);
		}

        return $this->render('portfolio/index.html.twig', [
            "projects" => $projects,
	        'categories' => $categories,
			"categoriesWithTechnos" => $categoriesWithTechnos
        ]);
    }

    #[Route('/{_locale<%app_locales%>}/projects', name: 'app_project')]
    public function projects(): Response
    {
        return $this->render('portfolio/project/index.html.twig', [

        ]);
    }
}
