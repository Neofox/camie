<?php

namespace App\Controller\Child;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildListController extends AbstractController
{
    /**
     * @Route("/child/list", name="child_list")
     */
    public function index()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('child_list/index.html.twig', ['children' => $user->getChildren()]);
    }
}
