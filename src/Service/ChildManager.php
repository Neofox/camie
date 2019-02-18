<?php

namespace App\Service;


use App\Entity\Child;
use App\Entity\Nursery;
use App\Entity\Sheet;
use App\Repository\ChildRepository;
use App\Repository\NurseryRepository;
use Doctrine\Common\Collections\ArrayCollection;

class ChildManager
{
    /**
     * @var NurseryRepository
     */
    private $nurseryRepository;
    /**
     * @var ChildRepository
     */
    private $childRepository;

    /**
     * UserManager constructor.
     *
     * @param NurseryRepository $nurseryRepository
     * @param ChildRepository   $childRepository
     */
    public function __construct(NurseryRepository $nurseryRepository, ChildRepository $childRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
        $this->childRepository = $childRepository;
    }

    /**
     * @param Nursery $nursery
     *
     * @return Child[]
     */
    public function retrieveChildrenOfNursery(Nursery $nursery): array
    {
        return $this->childRepository->findBy(['nursery' => $nursery]);
    }

    /**
     * @param string $childId
     *
     * @return Child
     */
    public function getChildById(string $childId): Child
    {
        $child = $this->childRepository->find($childId);

        if (!$child) {
            throw new \LogicException(sprintf('The child with ID "%s" does not exist.', $child));
        }

        return $child;
    }

    public function addSheet(Child $child, Sheet $sheet): Child
    {
        return $this->childRepository->addSheet($child, $sheet);
    }
}
