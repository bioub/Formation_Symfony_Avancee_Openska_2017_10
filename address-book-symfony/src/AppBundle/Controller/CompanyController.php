<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/companies")
 */
class CompanyController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $repo = $this->getDoctrine()->getRepository(Company::class);
        $companies = $repo->findBy([], null, 20);

        return $this->render('AppBundle:Company:list.html.twig', [
            'companies' => $companies,
        ]);
    }

    /**
     * @Route("/{id}")
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository(Company::class);
        $company = $repo->find($id);

        return $this->render('AppBundle:Company:show.html.twig', [
            'company' => $company
        ]);
    }

}
