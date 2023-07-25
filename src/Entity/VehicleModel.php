<?php

namespace App\Entity;

use App\Repository\VehicleModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleModelRepository::class)]
class VehicleModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleBrand $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $segment = null;

    #[ORM\OneToMany(mappedBy: 'vehicleModel', targetEntity: ServiceInfo::class, orphanRemoval: true)]
    private Collection $serviceInfos;

    public function __construct()
    {
        $this->serviceInfos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?VehicleBrand
    {
        return $this->brand;
    }

    public function setBrand(?VehicleBrand $brand): static
    {
        $this->brand = $brand;

        return $this;
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

    public function getSegment(): ?string
    {
        return $this->segment;
    }

    public function setSegment(string $segment): static
    {
        $this->segment = $segment;

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
            $serviceInfo->setVehicleModel($this);
        }

        return $this;
    }

    public function removeServiceInfo(ServiceInfo $serviceInfo): static
    {
        if ($this->serviceInfos->removeElement($serviceInfo)) {
            // set the owning side to null (unless already changed)
            if ($serviceInfo->getVehicleModel() === $this) {
                $serviceInfo->setVehicleModel(null);
            }
        }

        return $this;
    }
}
