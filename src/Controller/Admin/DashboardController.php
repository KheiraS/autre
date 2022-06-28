<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[isGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/homepage.html.twig');
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Nimes\'alerie')
            ->setTitle('<img src="/images/default/logo.png"/>');
    }




    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-filter', Category::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-file-invoice', Order::class);
        yield MenuItem::linkToCrud('Marques', 'fas fa-copyright', Brand::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-store', Product::class);
        yield MenuItem::linkToUrl('La Nîmes\'alerie', 'fas fa-paw', $this->generateUrl('default'));

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
        ->setName($user->getLastname())
        ->setAvatarUrl('/images/default/monsieur-capard.jpg');


    }
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('bundles/easyadmin/css/style.css');
    }

}
