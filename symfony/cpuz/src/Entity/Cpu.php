<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CpuRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CpuRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Patch(),
    ]
)]
class Cpu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16)]
    private ?string $brand = null;

    #[ORM\Column(length: 16)]
    private ?string $family = null;

    #[ORM\Column(length: 16)]
    private ?string $model = null;

    #[ORM\Column]
    private ?float $ghz = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\OneToMany(targetEntity: CpuProduction::class, mappedBy: 'cpuId')]
    private Collection $cpuProductions;

    #[ORM\Column]
    private ?int $stock = null;

    public function __construct()
    {
        $this->cpuProductions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): static
    {
        $this->family = $family;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getGhz(): ?float
    {
        return $this->ghz;
    }

    public function setGhz(float $ghz): static
    {
        $this->ghz = $ghz;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, CpuProduction>
     */
    public function getCpuProductions(): Collection
    {
        return $this->cpuProductions;
    }

    public function addCpuProduction(CpuProduction $cpuProduction): static
    {
        if (!$this->cpuProductions->contains($cpuProduction)) {
            $this->cpuProductions->add($cpuProduction);
            $cpuProduction->setCpu($this);
        }

        return $this;
    }

    public function removeCpuProduction(CpuProduction $cpuProduction): static
    {
        if ($this->cpuProductions->removeElement($cpuProduction)) {
            // set the owning side to null (unless already changed)
            if ($cpuProduction->getCpu() === $this) {
                $cpuProduction->setCpu(null);
            }
        }

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
