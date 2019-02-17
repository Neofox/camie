<?php

namespace App\Service;


use App\Entity\Child;
use App\Entity\Guardian;
use App\Entity\Nurse;
use App\Entity\User;
use App\Repository\UserRepository;

class UserManager
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ChildManager
     */
    private $childManager;

    /**
     * UserManager constructor.
     *
     * @param UserRepository $userRepository
     * @param ChildManager   $childManager
     */
    public function __construct(UserRepository $userRepository, ChildManager $childManager)
    {
        $this->userRepository = $userRepository;
        $this->childManager = $childManager;
    }

    /**
     * @param User $user
     *
     * @return Nurse|Guardian
     */
    public function getGuardianOrNurse(User $user)
    {
        // try to find the nurse
        $entity = $this->userRepository->findRelatedNurse($user);

        // If no nurse, get the guardian
        $res =  $entity ? $entity : $this->userRepository->findRelatedGuardian($user);

        if (!$res) {
            throw new \LogicException(sprintf('No guardian or nurse assocciated to the user %s', $user->getId()));
        }

        return $res;
    }

    /**
     * @param string|Child $child
     * @param Nurse $nurse
     */
    public function assignChildToNurse($child, Nurse $nurse)
    {
        if (!$child instanceof Child){
            $child = $this->childManager->getChildById($child);
        }

        $this->userRepository->assignChildToNurse($child, $nurse);

    }
}
