<?php

namespace App\Controller\Sheet;

use App\Entity\Sheet;
use App\Service\ChildManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SheetHistoryController extends AbstractController
{
    /**
     * @Route("/child/{childId}/sheets/history", name="sheets_history")
     *
     * @param string       $childId
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(string $childId, ChildManager $childManager)
    {
        $child = $childManager->getChildById($childId);
        /** @var \ArrayIterator $sheetsIterator */
        $sheetsIterator = $child->getSheets()->getIterator();
        $sheetsIterator->uasort(function(Sheet $first, Sheet $second) {return $first->getCreatedAt() > $second->getCreatedAt() ? -1 : 1;});

        return $this->render('sheet_history/index.html.twig', ['child' => $child, 'sheets' => $sheetsIterator]);
    }


    /**
     * @Route("/child/{childId}/sheets/{sheetId}/history", name="sheet_history_view")
     *
     * @param string       $childId
     * @param string       $sheetId
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(string $childId, string $sheetId, ChildManager $childManager)
    {
        $child = $childManager->getChildById($childId);
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();

        return $this->render('sheet_view/daily.html.twig', ['child' => $child, 'sheet' => $sheet, 'readonly' => true]);
    }

}
