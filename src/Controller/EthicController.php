<?php

namespace App\Controller;

use App\Repository\EthicRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EthicController extends AbstractController
{
    /**
     * @Route({"fr": "/ethique", "en": "/ethic"}, name="app_ethic")
     */
    public function index(EthicRepository $repo)
    {
        $article = $repo->findOneBy([], ['id' => 'DESC']);

        return $this->render('ethic/index.html.twig', [
            'article' => $article,
        ]);
    }
}
