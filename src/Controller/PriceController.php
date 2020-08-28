<?php

namespace App\Controller;

use App\Repository\PriceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PriceController extends AbstractController
{
    /**
     * @Route("/horaires-tarifs", name="app_price")
     */
    public function index(PriceRepository $repo)
    {
        $article = $repo->findOneBy([], ['id' => 'DESC']);

        return $this->render('price/index.html.twig', [
            'article' => $article,
        ]);
    }
}
