<?php

namespace App\Controller\Admin;

use App\Entity\Achat;
use App\Entity\Contact;
use App\Entity\Expediteur;
use App\Entity\User;
use App\Entity\Voyageur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ExpediteurCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('COPAVIA');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Voyageurs', 'fas fa-plane', Voyageur::class);
        yield MenuItem::linkToCrud('Les envoies', 'fas fa-list', Expediteur::class);
        yield MenuItem::linkToCrud('Les achats', 'fas fa-shopping-cart', Achat::class);
        yield MenuItem::linkToCrud('Prise de contact client', 'fas fa-phone', Contact::class);
    }
}
