<?php

namespace App\Controller;

use App\Entity\Actuality\Actuality;
use App\Entity\Actuality\ActualityComment;
use App\Form\ActualityCommentsType;
use App\Repository\ActualityCommentRepository;
use App\Repository\ActualityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actualites", name="app_actualities")
     */
    public function showAll(ActualityRepository $repo)
    {
        $allActuality = $repo->findAll();

        return $this->render('actuality/show_all.html.twig', [
            'all_actuality' => $allActuality,
        ]);
    }

    /**
     * @Route("/actualite/{slug}", name="app_actuality")
     */
    public function showSingle(Actuality $actuality, Request $request, EntityManagerInterface $manager, ActualityCommentRepository $commentRepo)
    {
        $comment = new ActualityComment();

        $showComments = $commentRepo->findBy(['actuality' => $actuality], ['id' => 'DESC']);

        $form = $this->createForm(ActualityCommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setActuality($actuality);
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash("success", "Votre commentaire a bien été posté");
            return $this->redirectToRoute('app_actuality', ['slug' => $actuality->getSlug()]);
        }

        return $this->render('actuality/show_single.html.twig', [
            'actuality' => $actuality,
            'comments' => $showComments,
            'form' => $form->createView()
        ]);
    }
}
