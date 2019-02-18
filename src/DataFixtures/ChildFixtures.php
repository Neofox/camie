<?php

namespace App\DataFixtures;

use App\Entity\Child;
use App\Entity\Nursery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ChildFixtures extends Fixture
{
    public const NB_CHILD = 10;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        /** @var Nursery $nursery */
        $nursery = $manager->getRepository(Nursery::class)->findOneBy(['name' => 'Fake Nursery']);

        for($i = 0;$i<self::NB_CHILD;$i++) {
            $child = new Child();
            $child->setFirstname($faker->firstName)
                ->setBirthdate($faker->dateTimeInInterval('-5 years', '-1 years'))
                ->setLastname($faker->lastName)
                ->setSexe($faker->randomElement(['F', 'M']))
                ->setNursery($nursery)
            ;

            $manager->persist($child);
        }

        $manager->flush();
    }
}
