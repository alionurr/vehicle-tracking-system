<?php

namespace App\Entity;

use App\Repository\ServiceInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceInfoRepository::class)]
class ServiceInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleBrand $vehicleBrand = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleModel $vehicleModel = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RepairType $repairType = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RepairPlace $repairPlace = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $repairDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getVehicleBrand(): ?VehicleBrand
    {
        return $this->vehicleBrand;
    }

    public function setVehicleBrand(?VehicleBrand $vehicleBrand): static
    {
        $this->vehicleBrand = $vehicleBrand;

        return $this;
    }

    public function getVehicleModel(): ?VehicleModel
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(?VehicleModel $vehicleModel): static
    {
        $this->vehicleModel = $vehicleModel;

        return $this;
    }

    public function getRepairType(): ?RepairType
    {
        return $this->repairType;
    }

    public function setRepairType(?RepairType $repairType): static
    {
        $this->repairType = $repairType;

        return $this;
    }

    public function getRepairPlace(): ?RepairPlace
    {
        return $this->repairPlace;
    }

    public function setRepairPlace(?RepairPlace $repairPlace): static
    {
        $this->repairPlace = $repairPlace;

        return $this;
    }

    public function getRepairDate(): ?\DateTimeInterface
    {
        return $this->repairDate;
    }

    public function setRepairDate(\DateTimeInterface $repairDate): static
    {
        $this->repairDate = $repairDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
