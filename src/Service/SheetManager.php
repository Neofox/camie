<?php

namespace App\Service;


use App\Entity\Child;
use App\Entity\Guardian;
use App\Entity\Nurse;
use App\Entity\User;
use App\Repository\SheetRepository;
use App\Repository\UserRepository;

class SheetManager
{
    /**
     * @var SheetRepository
     */
    private $sheetRepository;

    /**
     * UserManager constructor.
     *
     * @param SheetRepository $sheetRepository
     */
    public function __construct(SheetRepository $sheetRepository)
    {
        $this->sheetRepository = $sheetRepository;
    }

    public function saveSheetData(array $data, string $sheetType)
    {

    }

}
