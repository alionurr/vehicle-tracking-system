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
        $vehicleBrand->setBrand('Audi');
        $manager->persist($vehicleBrand);

        $vehicleBrand2 = new VehicleBrand();
        $vehicleBrand2->setBrand('BMW');
        $manager->persist($vehicleBrand2);

        $vehicleBrand3 = new VehicleBrand();
        $vehicleBrand3->setBrand('Volkswagen');
        $manager->persist($vehicleBrand3);

        $manager->flush();
    }
}
