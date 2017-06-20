<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\Barbecue;

class BarbecueControllerTest extends WebTestCase
{
    // /**
    //  * {@inheritDoc}
    //  */
    // protected function setUp()
    // {
    //     self::bootKernel();
    //
    //     // Not good way, but enough for now.
    //     $em = static::$kernel->getContainer()->get('doctrine')->getManager();
    //     $repository = $em->getRepository(Barbecue::class);
    //
    //     foreach ($repository->findAll() as $bbq) {
    //         $em->remove($bbq);
    //     }
    //
    //     $em->flush();
    // }

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/barbecue/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /barbecue/");
        $crawler = $client->click($crawler->selectLink('Create a new barbecue')->link());

        // Fill in the form and submit it
        $formValues = [
            'appbundle_barbecue[startAt]' => (new \DateTime('today'))->format('Y-m-d'),
            'appbundle_barbecue[label]' => 'Super Mega BBQ',
            'appbundle_barbecue[address]' => 'ici !',
            'appbundle_barbecue[peopleLimit]' => 100000,
            'appbundle_barbecue[billPrice]' => 150
        ];
        $form = $crawler->selectButton('Create')->form($formValues);

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Super Mega BBQ")')->count(), 'Missing element td:contains("Super Mega BBQ")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $formValues = [
            'appbundle_barbecue[startAt]' => (new \DateTime('next week'))->format('Y-m-d'),
            'appbundle_barbecue[label]' => 'Super BBQ',
            'appbundle_barbecue[address]' => 'ici',
            'appbundle_barbecue[peopleLimit]' => 10000,
            'appbundle_barbecue[billPrice]' => 15
        ];
        $form = $crawler->selectButton('Edit')->form($formValues);

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Super BBQ" (label).
        $this->assertGreaterThan(0, $crawler->filter('[value="Super BBQ"]')->count(), 'Missing element [value="Super BBQ"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    public function testIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/barbecue/');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertContains('Barbecues list', $crawler->filter('h1')->first()->text());
        $this->assertCount(1, $crawler->filter('table'));
    }
}
