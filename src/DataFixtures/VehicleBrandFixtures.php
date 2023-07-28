<?php

namespace App\DataFixtures;

use App\Entity\VehicleBrand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleBrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicleBrand = new VehicleBrand();
        $vehicleBrand->setName('Audi');
        $manager->persist($vehicleBrand);

        $vehicleBrand2 = new VehicleBrand();
        $vehicleBrand2->setName('BMW');
        $manager->persist($vehicleBrand2);

        $vehicleBrand3 = new VehicleBrand();
        $vehicleBrand3->setName('Volkswagen');
        $manager->persist($vehicleBrand3);

        $manager->flush();

        $this->addReference('vehicle_brand', $vehicleBrand);
        $this->addReference('vehicle_brand2', $vehicleBrand2);
        $this->addReference('vehicle_brand3', $vehicleBrand3);
    }
}
