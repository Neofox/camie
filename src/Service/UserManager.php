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
     * @param string|Child $child
     * @param User         $user
     */
    public function assignChildToNurse($child, User $user)
    {
        if (!$child instanceof Child){
            $child = $this->childManager->getChildById($child);
        }
        if (!in_array('ROLE_NURSE', $user->getRoles())) {
            throw new \RuntimeException(
                sprintf(
                    'User with ID "%s" does not have the role ROLE_NURSE. Child can only be assign to nurses.',
                    $user->getId()
                )
            );
        }

        $this->userRepository->assignChildToNurse($child, $user);
    }

    /**
     * @param string|Child $child
     * @param User         $user
     */
    public function unAssignChildToNurse($child, User $user)
    {
        if (!$child instanceof Child){
            $child = $this->childManager->getChildById($child);
        }
        if (!in_array('ROLE_NURSE', $user->getRoles())) {
            throw new \RuntimeException(
                sprintf(
                    'User with ID "%s" does not have the role ROLE_NURSE. Child can only be assign to nurses.',
                    $user->getId()
                )
            );
        }

        $this->userRepository->unAssignChildToNurse($child, $user);
    }
}
