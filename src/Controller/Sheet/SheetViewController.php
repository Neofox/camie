<?php

namespace App\Controller\Sheet;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SheetViewController extends AbstractController
{
    /**
     * @Route("/sheet/{id}/view", name="sheet_view")
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id)
    {
        return $this->render('sheet_view/index.html.twig', [
            'controller_name' => 'SheetViewController',
        ]);
    }
}
