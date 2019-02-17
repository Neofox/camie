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
        $user->setEmail('toto@camie.lu');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'toto'));
        $user->setNursery($nursery);
        $manager->persist($user);

        $nurse = new Nurse();
        $nurse->setFirstname($faker->firstName());
        $nurse->setLastname($faker->lastName);
        $nurse->setPhone($faker->phoneNumber);
        $nurse->setUser($user);

        $manager->persist($nurse);

        $user->setRoles(['ROLE_NURSE']);

        $manager->flush();
    }
}
