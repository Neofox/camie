<?php

namespace App\Controller\Child;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildCreateController extends AbstractController
{
    /**
     * @Route("/child/{id}/create", name="child_create")
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id)
    {
        return $this->render('child_create/index.html.twig', [
            'controller_name' => 'ChildCreateController',
        ]);
    }
}
