<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 27/10/2017
 * Time: 12:17
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Contact;
use AppBundle\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;

class ContactManager
{
    /** @var ContactRepository */
    protected $repository;

    /** @var EntityManager */
    protected $em;

    /**
     * ContactManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Contact::class);
    }


    public function getList() {

    }

    public function getById($id) {
        return $this->repository->find($id);
    }

    public function insert($contact) {

    }
}
