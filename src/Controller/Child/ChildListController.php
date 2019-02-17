<?php

namespace App\Controller\Child;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildListController extends AbstractController
{
    /**
     * @Route("/child/list", name="child_list")
     */
    public function index()
    {
        return $this->render('child_list/index.html.twig', [
            'controller_name' => 'ChildListController',
        ]);
    }
}
