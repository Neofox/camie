<?php

namespace App\Controller\Child;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChildCreateController extends AbstractController
{
    /**
     * @Route("/child/create", name="child_create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {

        if($request->getMethod() === 'POST'){
            dump($request->request->all());
        }

        return $this->render('child_create/index.html.twig', []);
    }
}
