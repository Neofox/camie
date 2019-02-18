<?php

namespace App\Controller\Sheet;

use App\Entity\Sheet;
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
     * @param SheetManager $sheetManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $id, ChildManager $childManager, SheetManager $sheetManager)
    {
        $defaultSheet = (new Sheet(Sheet::TYPE_DAILY))->setData(
            ['arrival_time' =>'' , 'departure_time' => '', 'communication' => '', 'activities' => '', 'nurse_comment' => '']
        );
        $child = $childManager->getChildById($id);
        $sheet = $sheetManager->getDailySheet($child) ?? $defaultSheet ;

        return $this->render('sheet_view/daily.html.twig', ['child' => $child, 'sheet' => $sheet]);
    }

    /**
     *
     * @Route("/sheet/{id}/view/ajax", name="sheet_view_ajax")
     *
     * @param Request      $request
     * @param string       $id
     * @param SheetManager $sheetManager
     * @param ChildManager $childManager
     *
     * @return JsonResponse
     */
    public function ajax(Request $request, string $id, SheetManager $sheetManager, ChildManager $childManager)
    {
        $sheetType = (int)$request->request->get('sheet_type');

        $data = $request->request->all();
        unset($data['sheet_type']);

        $child = $childManager->getChildById($id);
        $sheetManager->saveSheetData($data, $child, $sheetType);

        //TODO: return something?
        return new JsonResponse('Ok');
    }
}
