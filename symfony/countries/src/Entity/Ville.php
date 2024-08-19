<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ApiResource(
    shortName:"ville",
    operations: [
        new Get(uriTemplate:'/ville/{id}'),
        new GetCollection(uriTemplate:'/villes'),
        new Post(uriTemplate:'/villes'),
        new Put(uriTemplate:'/ville/{id}'),
        new Delete(uriTemplate:'/ville/{id}')
    ],
    normalizationContext: ['groups' => ['city']] // required: downgrade doctrine to 2.17
    )]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['country', 'city'])]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    #[Groups(['country', 'city'])]
    private ?string $codePostalVille = null;

    #[ORM\Column(length: 255)]
    #[Groups(['country', 'city'])]
    private ?string $nomVille = null;

    #[ORM\ManyToOne(inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['city'])]
    private ?Pays $pays = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePostalVille(): ?string
    {
        return $this->codePostalVille;
    }

    public function setCodePostalVille(string $codePostalVille): static
    {
        $this->codePostalVille = $codePostalVille;

        return $this;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): static
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }
}
