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

        //TODO: refactor this part
        if (isset($data['stools']) && isset($sheet->getData()['stools'])) {
            $data['stools'] += $sheet->getData()['stools'];
        }
        if (isset($data['sleep']) && isset($sheet->getData()['sleep'])) {
            $data['sleep'] += $sheet->getData()['sleep'];
        }
        if (isset($data['meal']) && isset($sheet->getData()['meal'])) {
            $data['meal'] += $sheet->getData()['meal'];
        }

        //If new data came from a sub form, don't erase other data
        $data = array_merge($sheet->getData(), $data);

        //TODO: validate data
        $sheet->setData($data);
        $this->sheetRepository->save($sheet);
    }

    public function getSheetTypes(): array
    {
        return (new ReflectionClass(Sheet::class))->getConstants();
    }

    public function getDailySheet(Child $child): ?Sheet
    {
        return $this->sheetRepository->findChildDailySheet($child);
    }

    public function removeSubData(Sheet $sheet, string $type, int $timestamp): Sheet
    {
        $data = $sheet->getData();
        unset($data[$type][$timestamp]);

        return $sheet->setData($data);
    }

    public function save(Sheet $sheet)
    {
        return $this->sheetRepository->save($sheet);
    }

}
