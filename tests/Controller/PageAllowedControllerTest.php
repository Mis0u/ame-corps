<?php

namespace tests\Controller;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageAllowedControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     * @param string $url
     */
    public function test(string $url)
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, $url);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * @return Generator
     */
    public function provideUrls(): Generator
    {
        yield ["/"];
        yield ["/actualites"];
        yield ["/definition"];
        yield ["/deroulement"];
        yield ["/bien-faits"];
        yield ["/horaires-tarifs"];
        yield ["/temoignages"];
        yield ["/ethique"];
        yield ["/contact"];
        yield ["/login"];
    }
}
