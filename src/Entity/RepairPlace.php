<?php

namespace App\Entity;

use App\Repository\RepairPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepairPlaceRepository::class)]
class RepairPlace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $monthlyCapacity = null;

    #[ORM\ManyToMany(targetEntity: RepairType::class, inversedBy: 'repairPlaces')]
    private Collection $repairType;

    #[ORM\OneToMany(mappedBy: 'repairPlace', targetEntity: ServiceInfo::class, orphanRemoval: true)]
    private Collection $serviceInfos;

    public function __construct()
    {
        $this->repairType = new ArrayCollection();
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

    public function getMonthlyCapacity(): ?int
    {
        return $this->monthlyCapacity;
    }

    public function setMonthlyCapacity(int $monthlyCapacity): static
    {
        $this->monthlyCapacity = $monthlyCapacity;

        return $this;
    }

    /**
     * @return Collection<int, RepairType>
     */
    public function getRepairType(): Collection
    {
        return $this->repairType;
    }

    public function addRepairType(RepairType $repairType): static
    {
        if (!$this->repairType->contains($repairType)) {
            $this->repairType->add($repairType);
        }

        return $this;
    }

    public function removeRepairType(RepairType $repairType): static
    {
        $this->repairType->removeElement($repairType);

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
            $serviceInfo->setRepairPlace($this);
        }

        return $this;
    }

    public function removeServiceInfo(ServiceInfo $serviceInfo): static
    {
        if ($this->serviceInfos->removeElement($serviceInfo)) {
            // set the owning side to null (unless already changed)
            if ($serviceInfo->getRepairPlace() === $this) {
                $serviceInfo->setRepairPlace(null);
            }
        }

        return $this;
    }
}
