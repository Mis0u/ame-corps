<?php

namespace App\Controller\Services;

use Symfony\Component\Mime\Address;


use Symfony\Component\Mailer\MailerInterface;


class EmailHandler
{
    public function send(MailerInterface $mailer, $component, $clientEmail, $message)
    {
        $email = ($component)
            ->from($clientEmail)
            ->to(new Address("misiti.mickael@gmail.com", 'Isabelle'))
            ->subject('Nouveau message de ' . $clientEmail->getName())
            ->htmlTemplate('email/receive.html.twig')
            ->context([
                'message' => $message,
                'destinataire' => $clientEmail->getAddress()
            ]);


        $mailer->send($email);
    }
}
