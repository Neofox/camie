<?php

namespace App\DataFixtures;

use App\Entity\Child;
use App\Entity\Sheet;
use App\Entity\SheetType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SheetFixtures extends Fixture
{
    public const NB_SHEETS = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $childs = $manager->getRepository(Child::class)->findAll();

        $dailySheet = new SheetType();
        $dailySheet->setName('Daily');

        $manager->persist($dailySheet);

        $date = new \DateTime();
        for($i = 0;$i<self::NB_SHEETS;$i++) {
            $sheetDate = clone $date;
            $sheetDate->sub(new \DateInterval("P{$i}D"));
            $sheet = new Sheet();
            $sheet->setType($dailySheet)
                ->setDate($sheetDate)
                ->setData(
                    [
                        'arrival_time' => '09:10',
                        'departure_time' => '16:30',
                        'activity' => 'Sleeping',
                        'communication_given' => '/',
                        'nurse_comment' => 'No comment.',
                    ]
                )
                ->addChild($childs[array_rand($childs)]);
            ;

            $manager->persist($sheet);
        }


        $manager->flush();
    }
}
