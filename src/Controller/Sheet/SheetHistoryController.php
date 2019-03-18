<?php

namespace App\Controller\Sheet;

use App\Entity\Sheet;
use App\Service\ChildManager;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
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
     * @Route("/child/{childId}/sheet/{sheetId}/history", name="sheet_history_view")
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
        /** @var Sheet $sheet */
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();

        return $this->render('sheet_view/daily.html.twig', ['child' => $child, 'sheet' => $sheet, 'readonly' => true]);
    }

    /**
     * @Route("/child/{childId}/sheet/{sheetId}/download", name="sheet_download")
     *
     * @param string       $childId
     * @param string       $sheetId
     * @param Pdf          $pdf
     * @param ChildManager $childManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadPdf(string $childId, string $sheetId, Pdf $pdf, ChildManager $childManager)
    {
        $child = $childManager->getChildById($childId);
        /** @var Sheet $sheet */
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();
        $filename = "{$child->getFirstname()}_{$child->getLastname()}_{$sheet->getCreatedAt()->format('dmY')}.pdf";

        $html = $this->renderView('sheet_view/daily-summary.html.twig', [
            'child' => $child,
            'sheet' => $sheet
        ]);

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $this->stripAccents($filename)
        );
    }


    /**
     * @Route("/child/{childId}/sheet/{sheetId}/send", name="sheet_email")
     *
     * @param string          $childId
     * @param string          $sheetId
     * @param KernelInterface $kernel
     *
     * @return Response
     * @throws \Exception
     */
    public function sendEmail(string $childId, string $sheetId, KernelInterface $kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'mail:sheet',
            'child' => $childId,
            'sheet' => $sheetId,
        ]);

        $application->run($input, new NullOutput());

        return new Response('', 204);
    }



    private function stripAccents(string $str): string {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

}
