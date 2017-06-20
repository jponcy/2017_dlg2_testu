<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndexGet()
    {
        $this->index('GET');
    }

    public function testIndexPost()
    {
        $this->index('POST');
    }

    protected function index($method)
    {
        $client = static::createClient();

        $crawler = $client->request($method, '/');

        $this->assertEquals(
                ($method === 'GET') ? 200 : 405,
                $client->getResponse()->getStatusCode());
    }
}
