<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\Gift;
use App\Entity\User;
use App\Entity\Letter;
use App\Entity\Comment;
use App\Entity\Message;
use App\Entity\Category;
use App\Entity\Reindeers;
use App\Entity\Department;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new ()
            ->setTitle('Santa Project');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // access only Santa user
        if ($this->isGranted('ROLE_ADMIN'))
        {
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        }
        yield MenuItem::linkToCrud('Rennes', 'fas fa-list', Reindeers::class);
        yield MenuItem::linkToCrud('Departements', 'fas fa-list', Department::class);
        yield MenuItem::linkToCrud('Ville', 'fas fa-list', City::class);
        yield MenuItem::linkToCrud('Cadeaux', 'fas fa-list', Gift::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-list', Comment::class);
        yield MenuItem::linkToCrud('Lettres', 'fas fa-list', Letter::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Messagerie', 'fas fa-list', Message::class);
    }
}
