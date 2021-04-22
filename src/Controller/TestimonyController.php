<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Form\TestimonyCommentsType;
use App\Repository\TestimonyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestimonyController extends AbstractController
{
    /**
     * @Route({"fr": "/temoignages", "en": "/testimonies"}, name="app_testimony")
     */
    public function displayTestimonies(Request $request, EntityManagerInterface $manager, TestimonyRepository $repo)
    {
        $newTestimony = new Testimony();

        $totalTestimonies = count($repo->findAll());

        $testimonies = $repo->findBy([], ['id' => 'DESC']);

        $form = $this->createForm(TestimonyCommentsType::class, $newTestimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($newTestimony);
            $manager->flush();

            $this->addFlash('success', 'Votre témoignage a bien été publié');
            return $this->redirectToRoute('app_testimony');
        }

        return $this->render('testimony/index.html.twig', [
            'testimonies' => $testimonies,
            'total_testimonies' => $totalTestimonies,
            'form' => $form->createView()
        ]);
    }
}
