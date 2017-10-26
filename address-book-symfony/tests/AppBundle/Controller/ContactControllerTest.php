<?php

namespace Tests\AppBundle\Controller;


use AppBundle\Entity\Contact;
use AppBundle\Repository\ContactRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();

        /*
         * TODO Réimporter un dump ici (entre chaque)
        $conn = $this->client->getContainer()->get('doctrine')->getConnection();
        $sql = file_get_contents('addressbook-mysql-dump.sql');
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        */
    }

    public function testListActionIsAccessible()
    {
        $this->client->request('GET', '/contacts/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowActionIsAccessible()
    {
        $this->client->request('GET', '/contacts/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testAddActionIsAccessible()
    {
        $this->client->request('GET', '/contacts/add');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testDeleteActionIsAccessible()
    {
        $this->client->request('GET', '/contacts/1/delete');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testUpdateActionIsAccessible()
    {
        $this->client->request('GET', '/contacts/1/update');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testShowActionContainsData()
    {
        $crawler = $this->client->request('GET', '/contacts/1');
        $h2Content = $crawler->filter('div.container > h2:first-child')->text();
        $this->assertContains('Bill Gates', $h2Content);
    }

    public function testShowActionContainsDataAvecMock()
    {
        $mockContactRepository = $this->getMockBuilder(ContactRepository::class)
                    ->disableOriginalConstructor()
                    ->getMock();

        $contact = new Contact();
        $contact->setFirstName('Jean')->setLastName('Dupont');

        $mockContactRepository
            ->expects($this->once())
            ->method('find')
            ->willReturn($contact);

        $mockRegistry = $this->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockRegistry
            ->expects($this->once())
            ->method('getRepository')
            ->willReturn($mockContactRepository);

        $this->client->getContainer()->set('doctrine', $mockRegistry);


        $crawler = $this->client->request('GET', '/contacts/1');
        $h2Content = $crawler->filter('div.container > h2:first-child')->text();
        $this->assertContains('Jean Dupont', $h2Content);
    }
}
