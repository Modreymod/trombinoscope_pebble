<?php

namespace App\Entity;

use App\Repository\PlageHoraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlageHoraireRepository::class)]
class PlageHoraire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomPlage = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $fin = null;

    #[ORM\Column]
    private ?int $numJour = null;

    #[ORM\ManyToMany(targetEntity: PlanningType::class, mappedBy: 'plagesHoraires')]
    private Collection $planningTypes;

    #[ORM\ManyToMany(targetEntity: Etat::class, inversedBy: 'plageHoraires')]
    private Collection $etats;

    public function __construct()
    {
        $this->planningTypes = new ArrayCollection();
        $this->etats = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlage(): ?string
    {
        return $this->nomPlage;
    }

    public function setNomPlage(string $nomPlage): self
    {
        $this->nomPlage = $nomPlage;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getNumJour(): ?int
    {
        return $this->numJour;
    }

    public function setNumJour(int $numJour): self
    {
        $this->numJour = $numJour;

        return $this;
    }

    /**
     * @return Collection<int, PlanningType>
     */
    public function getPlanningTypes(): Collection
    {
        return $this->planningTypes;
    }

    public function addPlanningType(PlanningType $planningType): self
    {
        if (!$this->planningTypes->contains($planningType)) {
            $this->planningTypes->add($planningType);
            $planningType->addPlagesHoraire($this);
        }

        return $this;
    }

    public function removePlanningType(PlanningType $planningType): self
    {
        if ($this->planningTypes->removeElement($planningType)) {
            $planningType->removePlagesHoraire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Etat>
     */
    public function getEtats(): Collection
    {
        return $this->etats;
    }

    public function addEtat(Etat $etat): self
    {
        if (!$this->etats->contains($etat)) {
            $this->etats->add($etat);
        }

        return $this;
    }

    public function removeEtat(Etat $etat): self
    {
        $this->etats->removeElement($etat);

        return $this;
    }

}
