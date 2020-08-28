<?php

namespace App\Controller\Sensitiv;

use App\Repository\DefinitionRepository;
use App\Repository\OperationRepository;
use App\Repository\WellDoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/definition", name="app_definition")
     */
    public function definition(DefinitionRepository $repo)
    {
        $article = $repo->findOneBy([], ['id' => 'DESC']);

        return $this->render('sensitiv/definition.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/deroulement", name="app_operation")
     */
    public function operation(OperationRepository $repo)
    {
        $article = $repo->findOneBy([], ['id' => 'DESC']);

        return $this->render('sensitiv/operation.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/bien-faits", name="app_well_done")
     */
    public function wellDone(WellDoneRepository $repo)
    {
        $article = $repo->findOneBy([], ['id' => 'DESC']);

        return $this->render('sensitiv/well_done.html.twig', [
            'article' => $article
        ]);
    }
}
