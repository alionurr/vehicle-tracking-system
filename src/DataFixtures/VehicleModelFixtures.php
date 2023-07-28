<?php

namespace App\DataFixtures;

use App\Entity\VehicleModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleModelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicleModel = new VehicleModel();
        $vehicleModel->setBrand($this->getReference('vehicle_brand'));
        $vehicleModel->setName('A3');
        $vehicleModel->setSegment('B');
        $manager->persist($vehicleModel);

        $vehicleModel2 = new VehicleModel();
        $vehicleModel2->setBrand($this->getReference('vehicle_brand'));
        $vehicleModel2->setName('A4');
        $vehicleModel2->setSegment('C');
        $manager->persist($vehicleModel2);

        $vehicleModel3 = new VehicleModel();
        $vehicleModel3->setBrand($this->getReference('vehicle_brand'));
        $vehicleModel3->setName('A5');
        $vehicleModel3->setSegment('C');
        $manager->persist($vehicleModel3);

        $vehicleModel4 = new VehicleModel();
        $vehicleModel4->setBrand($this->getReference('vehicle_brand2'));
        $vehicleModel4->setName('320');
        $vehicleModel4->setSegment('B');
        $manager->persist($vehicleModel4);

        $vehicleModel5 = new VehicleModel();
        $vehicleModel5->setBrand($this->getReference('vehicle_brand2'));
        $vehicleModel5->setName('520');
        $vehicleModel5->setSegment('C');
        $manager->persist($vehicleModel5);

        $vehicleModel6 = new VehicleModel();
        $vehicleModel6->setBrand($this->getReference('vehicle_brand3'));
        $vehicleModel6->setName('Golf');
        $vehicleModel6->setSegment('C');
        $manager->persist($vehicleModel6);

        $vehicleModel7 = new VehicleModel();
        $vehicleModel7->setBrand($this->getReference('vehicle_brand3'));
        $vehicleModel7->setName('Polo');
        $vehicleModel7->setSegment('B');
        $manager->persist($vehicleModel7);

        $vehicleModel8 = new VehicleModel();
        $vehicleModel8->setBrand($this->getReference('vehicle_brand3'));
        $vehicleModel8->setName('Passat');
        $vehicleModel8->setSegment('D');
        $manager->persist($vehicleModel8);

        $manager->flush();
    }
}
