<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SessionsVoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SessionsVoteRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    //normalizationContext: ['groups' => ['toto']]
)]
class SessionsVote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('toto')]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups('toto')]
    private ?int $nbTours = null;

    #[ORM\Column]
    #[Groups('toto')]
    private ?int $nbRepresentants = null;

    #[ORM\Column(length: 10)]
    #[Groups('toto')]
    private ?string $statut = null;

    #[ORM\OneToMany(targetEntity: SessionsCandidat::class, mappedBy: 'session')]
    #[Groups('toto')]
    private Collection $candidats;

    public function __construct()
    {
        $this->candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbTours(): ?int
    {
        return $this->nbTours;
    }

    public function setNbTours(int $nbTours): static
    {
        $this->nbTours = $nbTours;

        return $this;
    }

    public function getNbRepresentants(): ?int
    {
        return $this->nbRepresentants;
    }

    public function setNbRepresentants(int $nbRepresentants): static
    {
        $this->nbRepresentants = $nbRepresentants;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, SessionsCandidat>
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(SessionsCandidat $candidat): static
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats->add($candidat);
            $candidat->setSession($this);
        }

        return $this;
    }

    public function removeCandidat(SessionsCandidat $candidat): static
    {
        if ($this->candidats->removeElement($candidat)) {
            // set the owning side to null (unless already changed)
            if ($candidat->getSession() === $this) {
                $candidat->setSession(null);
            }
        }

        return $this;
    }
}
