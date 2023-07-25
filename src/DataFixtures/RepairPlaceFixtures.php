<?php

namespace App\DataFixtures;

use App\Entity\RepairPlace;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class RepairPlaceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $repairPlace = new RepairPlace();
        $repairPlace->setPlace('ali usta');
        $repairPlace->setMonthlyCapacity(10);
        $repairPlace->addRepairType($this->getReference('repair_type'));
        $repairPlace->addRepairType($this->getReference('repair_type2'));
        $manager->persist($repairPlace);

        $repairPlace2 = new RepairPlace();
        $repairPlace2->setPlace('onur usta');
        $repairPlace2->setMonthlyCapacity(20);
        $repairPlace2->addRepairType($this->getReference('repair_type2'));
        $repairPlace2->addRepairType($this->getReference('repair_type3'));
        $manager->persist($repairPlace2);

        $repairPlace3 = new RepairPlace();
        $repairPlace3->setPlace('ahmet usta');
        $repairPlace3->setMonthlyCapacity(30);
        $repairPlace3->addRepairType($this->getReference('repair_type'));
        $repairPlace3->addRepairType($this->getReference('repair_type3'));
        $manager->persist($repairPlace3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RepairTypeFixtures::class,
        ];
    }
}
