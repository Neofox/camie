<?php

namespace App\Service;


use App\Entity\Child;
use App\Entity\Nursery;
use App\Entity\Sheet;
use App\Repository\ChildRepository;
use App\Repository\NurseryRepository;
use Doctrine\Common\Collections\ArrayCollection;

class NurseryManager
{
    /**
     * @var NurseryRepository
     */
    private $nurseryRepository;

    /**
     * UserManager constructor.
     *
     * @param NurseryRepository $nurseryRepository
     */
    public function __construct(NurseryRepository $nurseryRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
    }

    /**
     * @param string $nurseryId
     *
     * @return Nursery
     */
    public function getById(string $nurseryId): Nursery
    {
        $nursery = $this->nurseryRepository->find($nurseryId);

        if (!$nursery) {
            throw new \LogicException(sprintf('The nursery with ID "%s" does not exist.', $nurseryId));
        }

        return $nursery;
    }

    /**
     * @return Nursery[]
     */
    public function getAll(): array
    {
        return $this->nurseryRepository->findAll();
    }
}
