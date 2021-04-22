<?php

namespace tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerTest extends WebTestCase
{
    public function testRedirectNotAllowed()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/admin/board');

        $this->assertResponseRedirects('/login');
    }

    public function testAllowed()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByUsername('admin');

        $client->loginUser($testUser);
        $client->request(Request::METHOD_GET, '/admin/board');

        $this->assertResponseIsSuccessful();
    }

    public function testNotAllowed()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByUsername('micka');

        $client->loginUser($testUser);
        $client->request(Request::METHOD_GET, '/admin/board');

        $this->assertEquals(Response::HTTP_FORBIDDEN, $client->getResponse()->getStatusCode());
    }
}
