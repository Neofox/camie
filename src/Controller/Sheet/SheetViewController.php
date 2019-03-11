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
     * @Route("/sheet/{childId}/daily", name="sheet_view")
     *
     * @param string       $childId
     * @param ChildManager $childManager
     * @param SheetManager $sheetManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $childId, ChildManager $childManager, SheetManager $sheetManager)
    {
        $defaultSheet = (new Sheet(Sheet::TYPE_DAILY))->setData(
            ['arrival_time' =>'' , 'departure_time' => '', 'communication' => '', 'activities' => '', 'nurse_comment' => '']
        );
        $child = $childManager->getChildById($childId);
        $sheet = $sheetManager->getDailySheet($child) ?? $defaultSheet ;

        return $this->render('sheet_view/daily.html.twig', ['child' => $child, 'sheet' => $sheet, 'readonly' => false]);
    }

    /**
     *
     * @Route("/sheet/{childId}/view/ajax", name="sheet_view_ajax")
     *
     * @param Request      $request
     * @param string       $childId
     * @param SheetManager $sheetManager
     * @param ChildManager $childManager
     *
     * @return JsonResponse
     */
    public function ajax(Request $request, string $childId, SheetManager $sheetManager, ChildManager $childManager)
    {
        $sheetType = (int)$request->request->get('sheet_type');
        $sheetId = $request->request->get('sheet_id');

        $data = $this->formatData($request);

        $child = $childManager->getChildById($childId);
        unset($data['sheet_type'], $data['sheet_id']);

        // We don't want to save data to the actual daily sheet when viewing past sheet
        if (!$sheetId || $sheetManager->getDailySheet($child)->getId() == $sheetId) {
            $sheetManager->saveSheetData($data, $child, $sheetType);
        }

        return new JsonResponse(null, 201);
    }

    /**
     *
     * @Route("/sheet/{childId}/view/ajax/remove", name="sheet_view_ajax_remove")
     *
     * @param Request      $request
     * @param string       $childId
     * @param ChildManager $childManager
     * @param SheetManager $sheetManager
     *
     * @return JsonResponse
     */
    public function ajax_remove(Request $request, string $childId, ChildManager $childManager, SheetManager $sheetManager): JsonResponse
    {
        $sheetId = $request->request->get('sheetId');

        $child = $childManager->getChildById($childId);
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();
        $sheet = $sheetManager->removeSubData($sheet, $request->request->get('type'), (int) $request->request->get('timestamp'));
        $sheetManager->save($sheet);

        return new JsonResponse(null, 204);
    }


    private function formatData(Request $request): array
    {
        $data = $request->request->all();
        //TODO: bad way to do that
        if ($stools = $request->request->get('stools')) {
            $data['stools'] = [time() => json_decode($stools)];
        }
        if ($sleep = $request->request->get('sleep')) {
            $data['sleep'] = [time() => json_decode($sleep)];
        }
        if ($meal = $request->request->get('meal')) {
            $data['meal'] = [time() => json_decode($meal)];
        }

        return $data;
    }
}
