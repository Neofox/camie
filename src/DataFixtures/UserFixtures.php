<?php

namespace App\DataFixtures;

use App\Entity\Nurse;
use App\Entity\Nursery;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
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
        $faker = Factory::create('fr_FR');

        /** @var Nursery $nursery */
        $nursery = $manager->getRepository(Nursery::class)->findOneBy(['name' => 'Fake Nursery']);

        $user = new User();
        $user->setEmail('nurse@camie.lu');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'nurse'));
        $user->setNursery($nursery);
        $user->setFirstname($faker->firstName());
        $user->setLastname($faker->lastName);
        $user->setPhone($faker->phoneNumber);
        $user->setRoles(['ROLE_NURSE']);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('guardian@camie.lu');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'guardian'));
        $user->setNursery($nursery);
        $user->setFirstname($faker->firstName());
        $user->setLastname($faker->lastName);
        $user->setPhone($faker->phoneNumber);
        $user->setRoles(['ROLE_GUARDIAN']);

        $manager->persist($user);

        $manager->flush();
    }
}
