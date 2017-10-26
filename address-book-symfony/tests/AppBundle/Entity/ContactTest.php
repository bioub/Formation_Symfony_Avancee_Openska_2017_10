<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /**
     * @var Contact
     */
    private $contact;

    public function setUp()
    {
        $this->contact = new Contact();
    }

    public function testGetSetFirstName() {

        $this->contact->setFirstName('Jean');
        $this->assertEquals('Jean', $this->contact->getFirstName());
    }

    public function testGetSetLastName() {

        $this->contact->setLastName('Dupont');
        $this->assertEquals('Dupont', $this->contact->getLastName());
    }

    public function testGetSetEmail() {

        $this->contact->setEmail('jdupont@gmail.com');
        $this->assertEquals('jdupont@gmail.com', $this->contact->getEmail());
    }

    public function testGetSetTelephone() {

        $this->contact->setTelephone('06 02 40 04 60');
        $this->assertEquals('06 02 40 04 60', $this->contact->getTelephone());
    }
}
