<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Ethic;
use App\Entity\Price;
use App\Entity\Homepage;
use App\Entity\Caroussel;
use App\Entity\Testimony;
use App\Entity\Sensitiv\WellDone;
use App\Entity\Sensitiv\Operation;
use App\Entity\Actuality\Actuality;
use App\Entity\Sensitiv\Definition;
use App\Repository\ActualityRepository;
use App\Repository\TestimonyRepository;
use App\Entity\Actuality\ActualityComment;
use App\Entity\Contact;
use App\Repository\ActualityCommentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $totalActualities;
    private $totalCommentsActualities;
    private $totalTesmonies;

    public function __construct(ActualityCommentRepository $actuCommentsRepo, ActualityRepository $actuRepo, TestimonyRepository $testimonyRepo)
    {
        $this->totalActualities = count($actuRepo->findAll());
        $this->totalCommentsActualities = count($actuCommentsRepo->findAll());
        $this->totalTesmonies = count($testimonyRepo->findAll());
    }

    /**
     * @Route("/admin/board", name="app_admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'total_actualities' =>  $this->totalActualities,
            'total_comments_actu' =>  $this->totalCommentsActualities,
            'total_testimonies' =>  $this->totalTesmonies
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ame Corps')
            ->setFaviconPath('build/images/logo-massage.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Actualités', 'fa fa-newspaper')->setSubItems([
            MenuItem::linkToCrud("Liste", 'fa fa-list', Actuality::class),
            MenuItem::linkToCrud("Commentaires", 'fa fa-comments', ActualityComment::class)
        ]);
        yield MenuItem::subMenu('Sensitiv', 'fa fa-spa')->setSubItems([
            MenuItem::linkToCrud("Définition", 'fa fa-pen-fancy', Definition::class),
            MenuItem::linkToCrud("Déroulement", 'fa fa-hand-holding-water', Operation::class),
            MenuItem::linkToCrud("Bien faits", 'fa fa-smile-beam', WellDone::class)
        ]);
        yield MenuItem::subMenu('Page d\'accueil', 'fa fa-tv')->setSubItems([
            MenuItem::linkToCrud("Page principale", 'fa fa-home', Homepage::class),
            MenuItem::linkToCrud("Caroussel", 'fa fa-images', Caroussel::class)
        ]);
        yield MenuItem::linkToCrud("Témoignages", 'fa fa-chalkboard-teacher', Testimony::class);
        yield MenuItem::linkToCrud("Horaires et tarifs", 'fa fa-euro-sign', Price::class);
        yield MenuItem::linkToCrud("Éthiques", 'fa fa-seedling', Ethic::class);
        yield MenuItem::linkToCrud("Contact", 'fa fa-envelope', Contact::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)

            ->addMenuItems([
                MenuItem::linkToRoute('Changer mon mot de passe', 'fa fa-lock', 'app_change_password'),
                MenuItem::linktoRoute('Retour à la page d\'accueil', 'fa fa-door-open', 'app_home')
            ]);
    }
}
