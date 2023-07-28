<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\ServiceInfo;
use Doctrine\ORM\EntityManagerInterface;

class ServiceInfoManager
{
    public $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    public function create($data): void
    {
        $customer = new Customer;
        $customer->setName($data->getCustomer()->getName());
        $customer->setSurname($data->getCustomer()->getSurname());
        $customer->setPhoneNumber($data->getCustomer()->getPhoneNumber());

        $this->getEntityManager()->persist($customer);

        $serviceInfo = new ServiceInfo;
        $serviceInfo->setCustomer($customer);
        $serviceInfo->setVehicleBrand($data->getVehicleBrand());
        $serviceInfo->setVehicleModel($data->getVehicleModel());
        $serviceInfo->setRepairDate($data->getRepairDate());
        $serviceInfo->setRepairType($data->getRepairType());
        $serviceInfo->setRepairPlace($data->getRepairPlace());

        $this->getEntityManager()->persist($serviceInfo);
        $this->getEntityManager()->flush();
    }

    public function _checkCustomerIfExist(Customer $data): bool
    {
        $foundCustomer = $this->getEntityManager()->getRepository(Customer::class)->findOneBy([
            'name' => $data->getName(),
            'surname' => $data->getSurname(),
        ]);

        if ($foundCustomer) {
            return true;
        }
        return false;
    }


    public function _checkRepairPlaceIfFull($repairDate, $repairPlace): bool
    {
        $foundData = $this->getEntityManager()->getRepository(ServiceInfo::class)->findOneBy([
            'repairPlace' => $repairPlace,
            'repairDate' => $repairDate
        ]);

        if ($foundData) {
            return true;
        }
        return false;
    }

    public function _getDataFromRequest($entityName, $id)
    {
        return $this->getEntityManager()->getRepository($entityName)->find($id);
    }

    /**
     * Get the value of entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
