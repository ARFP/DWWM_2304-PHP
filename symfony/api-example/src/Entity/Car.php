<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['car']]
)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('car')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[SerializedName('carBrand')]
    #[Groups(['car', 'register'])]
    private ?string $car_brand = null;

    #[ORM\Column(length: 50)]
    #[SerializedName('carModel')]
    #[Groups(['car', 'register'])]
    private ?string $car_model = null;

    #[ORM\Column]
    #[SerializedName('carPrice')]
    private ?int $car_price = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarRegister::class)]
    #[Groups('car')]
    private Collection $carRegisters;

    public function __construct()
    {
        $this->carRegisters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarBrand(): ?string
    {
        return $this->car_brand;
    }

    public function setCarBrand(string $car_brand): static
    {
        $this->car_brand = $car_brand;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->car_model;
    }

    public function setCarModel(string $car_model): static
    {
        $this->car_model = $car_model;

        return $this;
    }

    public function getCarPrice(): ?int
    {
        return $this->car_price;
    }

    public function setCarPrice(int $car_price): static
    {
        $this->car_price = $car_price;

        return $this;
    }

    /**
     * @return Collection<int, CarRegister>
     */
    public function getCarRegisters(): Collection
    {
        return $this->carRegisters;
    }

    public function addCarRegister(CarRegister $carRegister): static
    {
        if (!$this->carRegisters->contains($carRegister)) {
            $this->carRegisters->add($carRegister);
            $carRegister->setCar($this);
        }

        return $this;
    }

    public function removeCarRegister(CarRegister $carRegister): static
    {
        if ($this->carRegisters->removeElement($carRegister)) {
            // set the owning side to null (unless already changed)
            if ($carRegister->getCar() === $this) {
                $carRegister->setCar(null);
            }
        }

        return $this;
    }
}
