<?php

namespace App\DataFixtures;

use App\Entity\Nurse;
use App\Entity\Nursery;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    protected $passwordEncoder;

    /**
     * UserFixtures constructor.
     *
     * @param $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $nusery = new Nursery();
        $nusery->setName("Toto's Nursery");
        $manager->persist($nusery);

        $user = new User();
        $user->setLogin('toto');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'toto'));
        $user->setNursery($nusery);
        $manager->persist($user);

        $nurse = new Nurse();
        $nurse->setFirstname('firstname');
        $nurse->setLastname('lastname');
        $nurse->setEmail('toto@camie.lu');
        $nurse->setPhone('03.88.85.88.85');
        $nurse->setUser($user);
        $manager->persist($nurse);

        $user->setRoles(['ROLE_NURSE']);

        $manager->flush();
    }
}
