<?php

namespace App\Service;


use App\Entity\Child;
use App\Entity\Guardian;
use App\Entity\Nurse;
use App\Entity\Sheet;
use App\Entity\User;
use App\Repository\SheetRepository;
use App\Repository\UserRepository;
use ReflectionClass;

class SheetManager
{
    /**
     * @var SheetRepository
     */
    private $sheetRepository;
    /**
     * @var ChildManager
     */
    private $childManager;

    /**
     * UserManager constructor.
     *
     * @param SheetRepository $sheetRepository
     * @param ChildManager    $childManager
     */
    public function __construct(SheetRepository $sheetRepository, ChildManager $childManager)
    {
        $this->sheetRepository = $sheetRepository;
        $this->childManager = $childManager;
    }

    /**
     * @param array $data
     * @param Child $child
     * @param int   $sheetType
     */
    public function saveSheetData(array $data, Child $child, int $sheetType)
    {
        if ($sheetType !== Sheet::TYPE_DAILY) {
            throw new \LogicException(sprintf('Type "%s" is not supported at the moment.', $sheetType));
        }
        $sheet = $this->sheetRepository->findChildDailySheet($child);

        if (!$sheet) {
            $sheet = new Sheet($sheetType);
            $sheet->addChild($child);
            $this->sheetRepository->createSheet($sheet);
        }

        //TODO: validate data
        $this->sheetRepository->updateSheetData($sheet, $data);
    }

    public function getSheetTypes(): array
    {
        return (new ReflectionClass(Sheet::class))->getConstants();
    }

    public function getDailySheet(Child $child): ?Sheet
    {
        return $this->sheetRepository->findChildDailySheet($child);
    }

}
