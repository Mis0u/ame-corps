<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use App\Repository\ContactRepository;
use App\Controller\Services\EmailHandler;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function getInTouch(Request $request, ContactRepository $repo, EmailHandler $email, MailerInterface $mailer)
    {
        $getArticle = $repo->findOneBy([], ['id' => 'DESC']);

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form['email']->getData();
            $clientName = $form['name']->getData();
            $message = $form['message']->getData();

            $email->send($mailer, new TemplatedEmail(), new Address($client, $clientName), $message);

            $this->addFlash('success', 'Votre message a bien été envoyé 😊');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'article' =>  $getArticle
        ]);
    }
}
