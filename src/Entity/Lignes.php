<?php

namespace App\Entity;

use App\Repository\LignesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignesRepository::class)
 */
class Lignes
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
    private $NomLigne;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="lignesDepart")
     */
    private $VilleDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="LignesArrive")
     */
    private $VilleArrive;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PointsArrets;

    /**
     * @ORM\OneToMany(targetEntity=Escales::class, mappedBy="ligne")
     */
    private $escales;

    /**
     * @ORM\OneToMany(targetEntity=Voyages::class, mappedBy="ligne")
     */
    private $voyages;

    public function __construct()
    {
        $this->escales = new ArrayCollection();
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLigne(): ?string
    {
        return $this->NomLigne;
    }

    public function setNomLigne(?string $NomLigne): self
    {
        $this->NomLigne = $NomLigne;

        return $this;
    }

    public function getVilleDepart(): ?Ville
    {
        return $this->VilleDepart;
    }

    public function setVilleDepart(?Ville $VilleDepart): self
    {
        $this->VilleDepart = $VilleDepart;

        return $this;
    }

    public function getVilleArrive(): ?Ville
    {
        return $this->VilleArrive;
    }

    public function setVilleArrive(?Ville $VilleArrive): self
    {
        $this->VilleArrive = $VilleArrive;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(?bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getPointsArrets(): ?string
    {
        return $this->PointsArrets;
    }

    public function setPointsArrets(?string $PointsArrets): self
    {
        $this->PointsArrets = $PointsArrets;

        return $this;
    }

    /**
     * @return Collection|Escales[]
     */
    public function getEscales(): Collection
    {
        return $this->escales;
    }

    public function addEscale(Escales $escale): self
    {
        if (!$this->escales->contains($escale)) {
            $this->escales[] = $escale;
            $escale->setLigne($this);
        }

        return $this;
    }

    public function removeEscale(Escales $escale): self
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getLigne() === $this) {
                $escale->setLigne(null);
            }
        }

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
            $voyage->setLigne($this);
        }

        return $this;
    }

    public function removeVoyage(Voyages $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getLigne() === $this) {
                $voyage->setLigne(null);
            }
        }

        return $this;
    }
}
