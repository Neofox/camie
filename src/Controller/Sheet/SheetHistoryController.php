<?php

namespace App\Controller\Sheet;

use App\Service\ChildManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SheetHistoryController extends AbstractController
{
    /**
     * @Route("/child/{id}/sheets/history", name="sheets_history")
     *
     * @param string       $id
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id, ChildManager $childManager)
    {
        $child = $childManager->getChildById($id);

        return $this->render('sheet_history/index.html.twig', ['child' => $child]);
    }
}
