<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CpuProductionRepository;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CpuProductionRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ]
)]
class CpuProduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $productionTime = null;

    #[ORM\ManyToOne(inversedBy: 'cpuProductions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cpu $cpu = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getProductionTime(): ?int
    {
        return $this->productionTime;
    }

    public function setProductionTime(int $productionTime): static
    {
        $this->productionTime = $productionTime;

        return $this;
    }

    public function getCpu(): ?Cpu
    {
        return $this->cpu;
    }

    public function setCpu(?Cpu $cpu): static
    {
        $this->cpu = $cpu;

        return $this;
    }
}
