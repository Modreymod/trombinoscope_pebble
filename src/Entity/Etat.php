<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomEtat = null;

    #[ORM\ManyToMany(targetEntity: PlageHoraire::class, mappedBy: 'etats')]
    private Collection $plageHoraires;

    public function __construct()
    {
        $this->plageHoraires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtat(): ?string
    {
        return $this->nomEtat;
    }

    public function setNomEtat(string $nomEtat): self
    {
        $this->nomEtat = $nomEtat;

        return $this;
    }

    /**
     * @return Collection<int, PlageHoraire>
     */
    public function getPlageHoraires(): Collection
    {
        return $this->plageHoraires;
    }

    public function addPlageHoraire(PlageHoraire $plageHoraire): self
    {
        if (!$this->plageHoraires->contains($plageHoraire)) {
            $this->plageHoraires->add($plageHoraire);
            $plageHoraire->addEtat($this);
        }

        return $this;
    }

    public function removePlageHoraire(PlageHoraire $plageHoraire): self
    {
        if ($this->plageHoraires->removeElement($plageHoraire)) {
            $plageHoraire->removeEtat($this);
        }

        return $this;
    }
}
