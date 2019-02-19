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

    public function createOrAssignGuardian(array $data, Child $child)
    {
        //TODO: validate data
        if (empty($data['email'])) {
            return;
        }

        if (!$user = $this->userRepository->findOneBy(['email' => $data['email']])) {
            $user = $this->createUser($data, ['ROLE_GUARDIAN'], $child->getNursery());
        }

        $user->addChild($child);
        $this->userRepository->save($user);
    }

    public function createUser(array $data, $role = ['ROLE_NURSE'], $nursery): User
    {
        //TODO: validate more the data
        $data = $this->validateUserData($data);

        $user = new User();
        $user
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setNursery($nursery)
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setRoles($role)
            ->setPassword($data['password'])
            ;
        $this->userRepository->save($user);

        return $user;
    }

    public function validateUserData($data): array
    {
        $validatedData = [];
        $validatedData['firstname'] = $data['firstname'] ?? '';
        $validatedData['lastname'] = $data['lastname'] ?? '';
        $validatedData['phone'] = $data['phone'] ?? '';
        //TODO: find an other way for the password
        $validatedData['password'] = $data['password'] ?? uniqid('password');
        $validatedData['email'] = $data['email'];

        return $validatedData;
    }
}
