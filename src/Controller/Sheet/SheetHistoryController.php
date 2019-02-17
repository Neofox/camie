<?php

namespace App\Controller\Sheet;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SheetHistoryController extends AbstractController
{
    /**
     * @Route("/child/{id}/sheets/history", name="sheets_history")
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id)
    {
        return $this->render('sheet_history/index.html.twig', [
            'controller_name' => 'SheetHistoryController',
        ]);
    }
}
