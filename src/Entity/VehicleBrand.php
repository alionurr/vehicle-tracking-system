<?php

namespace App\Entity;

use App\Repository\VehicleBrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleBrandRepository::class)]
class VehicleBrand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: VehicleModel::class)]
    private Collection $vehicleModels;

    #[ORM\OneToMany(mappedBy: 'vehicleBrand', targetEntity: ServiceInfo::class, orphanRemoval: true)]
    private Collection $serviceInfos;

    public function __construct()
    {
        $this->vehicleModels = new ArrayCollection();
        $this->serviceInfos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, VehicleModel>
     */
    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }

    public function addVehicleModel(VehicleModel $vehicleModel): static
    {
        if (!$this->vehicleModels->contains($vehicleModel)) {
            $this->vehicleModels->add($vehicleModel);
            $vehicleModel->setBrand($this);
        }

        return $this;
    }

    public function removeVehicleModel(VehicleModel $vehicleModel): static
    {
        if ($this->vehicleModels->removeElement($vehicleModel)) {
            // set the owning side to null (unless already changed)
            if ($vehicleModel->getBrand() === $this) {
                $vehicleModel->setBrand(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ServiceInfo>
     */
    public function getServiceInfos(): Collection
    {
        return $this->serviceInfos;
    }

    public function addServiceInfo(ServiceInfo $serviceInfo): static
    {
        if (!$this->serviceInfos->contains($serviceInfo)) {
            $this->serviceInfos->add($serviceInfo);
            $serviceInfo->setVehicleBrand($this);
        }

        return $this;
    }

    public function removeServiceInfo(ServiceInfo $serviceInfo): static
    {
        if ($this->serviceInfos->removeElement($serviceInfo)) {
            // set the owning side to null (unless already changed)
            if ($serviceInfo->getVehicleBrand() === $this) {
                $serviceInfo->setVehicleBrand(null);
            }
        }

        return $this;
    }
}
