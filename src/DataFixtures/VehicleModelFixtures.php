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
        $vehicleModel->setBrandId(1);
        $vehicleModel->setModel('A3');
        $vehicleModel->setSegment('B');
        $manager->persist($vehicleModel);

        $vehicleModel2 = new VehicleModel();
        $vehicleModel2->setBrandId(1);
        $vehicleModel2->setModel('A4');
        $vehicleModel2->setSegment('C');
        $manager->persist($vehicleModel2);

        $vehicleModel3 = new VehicleModel();
        $vehicleModel3->setBrandId(1);
        $vehicleModel3->setModel('A5');
        $vehicleModel3->setSegment('C');
        $manager->persist($vehicleModel3);

        $vehicleModel4 = new VehicleModel();
        $vehicleModel4->setBrandId(2);
        $vehicleModel4->setModel('320');
        $vehicleModel4->setSegment('B');
        $manager->persist($vehicleModel4);

        $vehicleModel5 = new VehicleModel();
        $vehicleModel5->setBrandId(2);
        $vehicleModel5->setModel('520');
        $vehicleModel5->setSegment('C');
        $manager->persist($vehicleModel5);

        $vehicleModel6 = new VehicleModel();
        $vehicleModel6->setBrandId(3);
        $vehicleModel6->setModel('Golf');
        $vehicleModel6->setSegment('C');
        $manager->persist($vehicleModel6);

        $vehicleModel7 = new VehicleModel();
        $vehicleModel7->setBrandId(3);
        $vehicleModel7->setModel('Polo');
        $vehicleModel7->setSegment('B');
        $manager->persist($vehicleModel7);

        $vehicleModel8 = new VehicleModel();
        $vehicleModel8->setBrandId(3);
        $vehicleModel8->setModel('Passat');
        $vehicleModel8->setSegment('D');
        $manager->persist($vehicleModel8);

        $manager->flush();
    }
}
