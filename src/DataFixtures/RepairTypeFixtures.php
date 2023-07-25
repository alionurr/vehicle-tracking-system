<?php

namespace App\DataFixtures;

use App\Entity\RepairType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RepairTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $repairType = new RepairType();
        $repairType->setType('yağ değişimi');
        $manager->persist($repairType);

        $repairType2 = new RepairType();
        $repairType2->setType('lastik değişimi');
        $manager->persist($repairType2);

        $repairType3 = new RepairType();
        $repairType3->setType('pasta cila');
        $manager->persist($repairType3);

        $manager->flush();

        /**
         * ara tabloyu oluşturmak için reference eklendi.
         * RepairplaceFixtures'ta bulunan kayıtlara reference eklenerek oluşur.
         */
        $this->addReference('repair_type', $repairType);
        $this->addReference('repair_type2', $repairType2);
        $this->addReference('repair_type3', $repairType3);
    }
}
