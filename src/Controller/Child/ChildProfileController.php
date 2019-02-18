<?php

namespace App\Controller\Child;

use App\Service\ChildManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildProfileController extends AbstractController
{
    /**
     * @Route("/child/{id}/profile", name="child_profile")
     *
     * @param string       $id
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id, ChildManager $childManager)
    {
        $child = $childManager->getChildById($id);

        return $this->render('child_profile/index.html.twig', ['child' => $child]);
    }
}
