<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Conversion;
use App\Entity\Page;
use App\Entity\Project;
use App\Entity\client;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\ClientCrudController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
	    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
	    return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());

	    //return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Kodkodkod Studio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Conversion', 'fas fa-list', Conversion::class);
	    yield MenuItem::linkToCrud('Project', 'fas fa-list', Project::class);
	    yield MenuItem::linkToCrud('Clients', 'fas fa-list', Client::class)->setController(ClientCrudController::class);
	    yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
	    yield MenuItem::linkToCrud('Blog', 'fas fa-list', Blog::class);
	    yield MenuItem::linkToCrud('Page', 'fas fa-list', Page::class);

    }
}
