<?php

namespace App\DataFixtures;

use App\Entity\Nursery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $nusery = new Nursery();
        $nusery->setName("Fake Nursery");

        $manager->persist($nusery);


        $manager->flush();
    }
}
