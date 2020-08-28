<?php

namespace App\Controller;

use App\Repository\CarousselRepository;
use App\Repository\HomepageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(CarousselRepository $carouRepo, HomepageRepository $homeRepo)
    {
        $caroussel = $carouRepo->findAll();
        $numberImages = count($caroussel);
        $article = $homeRepo->findOneBy([], ['id' => 'DESC']);

        return $this->render('home/index.html.twig', [
           'caroussel' => $caroussel,
           'total_images' => $numberImages,
           'article' => $article
        ]);
    }
}
