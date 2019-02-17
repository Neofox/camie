<?php

namespace App\Controller\Child;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildProfileController extends AbstractController
{
    /**
     * @Route("/child/profile", name="child_profile")
     */
    public function index()
    {
        return $this->render('child_profile/index.html.twig', [
            'controller_name' => 'ChildProfileController',
        ]);
    }
}
