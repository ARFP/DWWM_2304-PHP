<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarAccessoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: CarAccessoryRepository::class)]
#[ApiResource]
class CarAccessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[SerializedName('accessoryName')]
    private ?string $accessory_name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[SerializedName('accessoryPrice')]
    private ?string $accessory_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccessoryName(): ?string
    {
        return $this->accessory_name;
    }

    public function setAccessoryName(string $accessory_name): static
    {
        $this->accessory_name = $accessory_name;

        return $this;
    }

    public function getAccessoryPrice(): ?string
    {
        return $this->accessory_price;
    }

    public function setAccessoryPrice(string $accessory_price): static
    {
        $this->accessory_price = $accessory_price;

        return $this;
    }
}
