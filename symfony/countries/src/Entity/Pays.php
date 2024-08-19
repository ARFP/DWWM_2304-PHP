<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ApiResource(
    shortName:"pays",
    operations: [
        new Get(uriTemplate:'/pays/{id}'),
        new GetCollection(uriTemplate:'/pays'),
        new Post(uriTemplate:'/pays'),
        new Put(uriTemplate:'/pays/{id}'),
        new Delete(uriTemplate:'/pays/{id}')
    ],
    normalizationContext: ['groups' => ['country']]
    )]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['country', 'city'])]
    private ?int $id = null;

    #[ORM\Column(length: 2, unique: true, options:["fixed" =>  true])]
    #[Groups(['country', 'city'])]
    private ?string $codePays = null;

    #[ORM\Column(length: 255)]
    #[Groups(['country', 'city'])]
    private ?string $nomPays = null;

    #[ORM\OneToMany(targetEntity: Ville::class, mappedBy: 'pays', fetch:'EXTRA_LAZY')]
    #[Groups('country')]
    private Collection $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): static
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): static
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->setPays($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getPays() === $this) {
                $ville->setPays(null);
            }
        }

        return $this;
    }
}
