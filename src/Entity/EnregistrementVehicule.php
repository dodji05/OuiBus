<?php

namespace App\Entity;

use App\Repository\EnregistrementVehiculeRepository;
use App\Entity\TypeVehicule;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=EnregistrementVehiculeRepository::class)
 */
class EnregistrementVehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumeroVehicule;

    /**
     * @ORM\ManyToOne(targetEntity=TypeVehicule::class, inversedBy="enregistrementVehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeVehicule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumeroMoteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumeroChassis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Marque;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Model;

    /**
     * @ORM\OneToMany(targetEntity=Voyages::class, mappedBy="bus")
     */
    private $voyages;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroVehicule(): ?string
    {
        return $this->NumeroVehicule;
    }

    public function setNumeroVehicule(?string $NumeroVehicule): self
    {
        $this->NumeroVehicule = $NumeroVehicule;

        return $this;
    }

    public function getTypeVehicule(): ?TypeVehicule
    {
        return $this->TypeVehicule;
    }

    public function setTypeVehicule(?TypeVehicule $TypeVehicule): self
    {
        $this->TypeVehicule = $TypeVehicule;

        return $this;
    }

    public function getNumeroMoteur(): ?string
    {
        return $this->NumeroMoteur;
    }

    public function setNumeroMoteur(?string $NumeroMoteur): self
    {
        $this->NumeroMoteur = $NumeroMoteur;

        return $this;
    }

    public function getNumeroChassis(): ?string
    {
        return $this->NumeroChassis;
    }

    public function setNumeroChassis(?string $NumeroChassis): self
    {
        $this->NumeroChassis = $NumeroChassis;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(?string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(?string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    /**
     * @return Collection|Voyages[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyages $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setBus($this);
        }

        return $this;
    }

    public function removeVoyage(Voyages $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getBus() === $this) {
                $voyage->setBus(null);
            }
        }

        return $this;
    }
}
