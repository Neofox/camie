<?php

namespace App\Controller\Sheet;

use App\Service\ChildManager;
use App\Service\SheetManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SheetViewController extends AbstractController
{
    /**
     * @Route("/sheet/{id}/view", name="sheet_view")
     *
     * @param string       $id
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id, ChildManager $childManager)
    {
        $child = $childManager->getChildById($id);

        return $this->render('sheet_view/daily.html.twig', ['child' => $child]);
    }

    /**
     *
     * @Route("/sheet/{id}/view/ajax", name="sheet_view_ajax")
     *
     * @param Request      $request
     * @param SheetManager $sheetManager
     *
     * @return JsonResponse
     */
    public function ajax(Request $request, SheetManager $sheetManager)
    {
        dump($request->request->all());



        return new JsonResponse('Ok');
    }
}
