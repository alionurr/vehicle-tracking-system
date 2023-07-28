<?php 

namespace App\Service;

use App\Entity\Customer;
use App\Entity\RepairPlace;
use App\Entity\ServiceInfo;
use App\Entity\VehicleModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ServiceInfoManager
{
    public function create($data, Request $request, EntityManagerInterface $entityManager): void
    {
        $customer = new Customer;
        $customer->setName($data->getCustomer()->getName());
        $customer->setSurname($data->getCustomer()->getSurname());
        $customer->setPhoneNumber($data->getCustomer()->getPhoneNumber());

        $entityManager->persist($customer);

        $requestData = $request->request->all();
        $vehicleModelId = $requestData['service_info']['vehicleModel'];
        $repairPlaceId = $requestData['service_info']['repairPlace'];
        $vehicleModel = $entityManager->getRepository(VehicleModel::class)->find($vehicleModelId);
        $repairPlace = $entityManager->getRepository(RepairPlace::class)->find($repairPlaceId);

        $serviceInfo = new ServiceInfo;
        $serviceInfo->setCustomer($customer);
        $serviceInfo->setVehicleBrand($data->getVehicleBrand());
        $serviceInfo->setVehicleModel($vehicleModel);
        $serviceInfo->setRepairDate($data->getRepairDate());
        $serviceInfo->setRepairType($data->getRepairType());
        $serviceInfo->setRepairPlace($repairPlace);

        $entityManager->persist($serviceInfo);
        $entityManager->flush();

    }
}