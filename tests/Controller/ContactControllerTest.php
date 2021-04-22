<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactControllerTest extends WebTestCase
{
    public function testSendEmail()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/contact');

        $buttonCrawlerNode = $crawler->selectButton('Envoyer');

        $form = $buttonCrawlerNode->form([
            'contact[email]' => 'test@gmail.com',
            'contact[name]' => 'micka',
            'contact[message]' => 'Ceci est un email',
        ]);

        $client->submit($form);

        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertSelectorTextContains('html div.alert-success', 'Votre message a bien été envoyé');
    }
}
