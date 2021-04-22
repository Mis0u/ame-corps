<?php

namespace tests\Controller;

use App\Repository\ActualityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class ActualityControllertest extends WebTestCase
{
    public function testPageAllowedAndContaintTitle()
    {
        $client = static::createClient();

        /** @var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = static::$container->get("router.default");

        $actualityRepository = static::$container->get(ActualityRepository::class);

        $testActuality = $actualityRepository->findOneBy([]);

        $client->request(Request::METHOD_GET, $urlGenerator->generate("app_actuality", ['slug' => $testActuality->getSlug()]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('html h1.title', $testActuality->getTitle());
    }

    public function testSendComment()
    {
        $client = static::createClient();

        /** @var UrlGeneratorInterface $urlGenerator */
        $urlGenerator = static::$container->get("router.default");

        $actualityRepository = static::$container->get(ActualityRepository::class);

        $testActuality = $actualityRepository->findOneBy([]);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate("app_actuality", ['slug' => $testActuality->getSlug()]));

        $buttonCrawlerNode = $crawler->selectButton('Envoyer');

        $form = $buttonCrawlerNode->form([
            'actuality_comments[email]' => 'untest@gmail.com',
            'actuality_comments[name]' => 'Mickael',
            'actuality_comments[content]' => 'Ceci est un test'
        ]);

        $client->submit($form);

        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertSelectorTextContains('html p.name', 'Mickael');
    }

    public function testAccessActualityFromActualities()
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/actualites');

        $link = $crawler->selectLink('Lire')->link();

        $client->click($link);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertRouteSame('app_actuality');
    }
}
