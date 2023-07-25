<?php

namespace App\Entity;

use App\Repository\RepairTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepairTypeRepository::class)]
class RepairType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: RepairPlace::class, mappedBy: 'repairType')]
    private Collection $repairPlaces;

    #[ORM\OneToMany(mappedBy: 'repairType', targetEntity: ServiceInfo::class, orphanRemoval: true)]
    private Collection $serviceInfos;

    public function __construct()
    {
        $this->repairPlaces = new ArrayCollection();
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
     * @return Collection<int, RepairPlace>
     */
    public function getRepairPlaces(): Collection
    {
        return $this->repairPlaces;
    }

    public function addRepairPlace(RepairPlace $repairPlace): static
    {
        if (!$this->repairPlaces->contains($repairPlace)) {
            $this->repairPlaces->add($repairPlace);
            $repairPlace->addRepairType($this);
        }

        return $this;
    }

    public function removeRepairPlace(RepairPlace $repairPlace): static
    {
        if ($this->repairPlaces->removeElement($repairPlace)) {
            $repairPlace->removeRepairType($this);
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
            $serviceInfo->setRepairType($this);
        }

        return $this;
    }

    public function removeServiceInfo(ServiceInfo $serviceInfo): static
    {
        if ($this->serviceInfos->removeElement($serviceInfo)) {
            // set the owning side to null (unless already changed)
            if ($serviceInfo->getRepairType() === $this) {
                $serviceInfo->setRepairType(null);
            }
        }

        return $this;
    }
}
