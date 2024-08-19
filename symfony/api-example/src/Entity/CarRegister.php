<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarRegisterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CarRegisterRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['register']]
)]
class CarRegister
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['car', 'register'])]
    private ?int $id = null;

    #[ORM\Column(length: 11)]
    #[SerializedName('carRegistration')]
    #[Groups(['car', 'register'])]
    private ?string $car_registration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[SerializedName('carDate')]
    #[Groups(['car', 'register'])]
    private ?\DateTimeInterface $car_date = null;

    #[ORM\ManyToOne(inversedBy: 'carRegisters')]
    #[Groups(['register'])]
    private ?Car $car = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarRegistration(): ?string
    {
        return $this->car_registration;
    }

    public function setCarRegistration(string $car_registration): static
    {
        $this->car_registration = $car_registration;

        return $this;
    }

    public function getCarDate(): ?\DateTimeInterface
    {
        return $this->car_date;
    }

    public function setCarDate(\DateTimeInterface $car_date): static
    {
        $this->car_date = $car_date;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }
}
