<?php

namespace tests\Controller;

use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClickLinkNavTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     * @param string $url
     */
    public function test(string $linkNav, string $url)
    {
        $client = static::createClient();

        $crawler = $client->request(Request::METHOD_GET, '/');

        $link = $crawler->selectLink($linkNav)->link();
        $client->click($link);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertRouteSame($url);
    }

    /**
     * @return Generator
     */
    public function provideUrls(): Generator
    {
        yield ['Accueil', 'app_home'];
        yield ['Actualités', 'app_actualities'];
        yield ['Définition', 'app_definition'];
        yield ['Bienfaits', 'app_well_done'];
        yield ['Horaires et tarifs', 'app_price'];
        yield ['Témoignages', 'app_testimony'];
        yield ['Éthique', 'app_ethic'];
        yield ['Contact', 'app_contact'];
    }
}
