<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $NomVille;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Status;

    /**
     * @ORM\OneToMany(targetEntity=Lignes::class, mappedBy="VilleDepart")
     */
    private $lignesDepart;

    /**
     * @ORM\OneToMany(targetEntity=Lignes::class, mappedBy="VilleArrive")
     */
    private $LignesArrive;

    /**
     * @ORM\OneToMany(targetEntity=Escales::class, mappedBy="VilleDepart")
     */
    private $escalesDepart;

    /**
     * @ORM\OneToMany(targetEntity=Escales::class, mappedBy="VilleArrive")
     */
    private $escalesArrive;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="VilleDepart")
     */
    private $reservationVilleDepart;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="VilleArrivee")
     */
    private $reservationVilleArrive;

    public function __construct()
    {
        $this->lignesDepart = new ArrayCollection();
        $this->LignesArrive = new ArrayCollection();
        $this->escalesDepart = new ArrayCollection();
        $this->escalesArrive = new ArrayCollection();
        $this->reservationVilleDepart = new ArrayCollection();
        $this->reservationVilleArrive = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->NomVille;
    }

    public function setNomVille(?string $NomVille): self
    {
        $this->NomVille = $NomVille;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

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

    /**
     * @return Collection|Lignes[]
     */
    public function getLignesDepart(): Collection
    {
        return $this->lignesDepart;
    }

    public function addLignesDepart(Lignes $lignesDepart): self
    {
        if (!$this->lignesDepart->contains($lignesDepart)) {
            $this->lignesDepart[] = $lignesDepart;
            $lignesDepart->setVilleDepart($this);
        }

        return $this;
    }

    public function removeLigne(Lignes $lignesDepart): self
    {
        if ($this->lignesDepart->removeElement($lignesDepart)) {
            // set the owning side to null (unless already changed)
            if ($lignesDepart->getVilleDepart() === $this) {
                $lignesDepart->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lignes[]
     */
    public function getLignesArrive(): Collection
    {
        return $this->LignesArrive;
    }

    public function addLignesArrive(Lignes $lignesArrive): self
    {
        if (!$this->LignesArrive->contains($lignesArrive)) {
            $this->LignesArrive[] = $lignesArrive;
            $lignesArrive->setVilleArrive($this);
        }

        return $this;
    }

    public function removeLignesArrive(Lignes $lignesArrive): self
    {
        if ($this->LignesArrive->removeElement($lignesArrive)) {
            // set the owning side to null (unless already changed)
            if ($lignesArrive->getVilleArrive() === $this) {
                $lignesArrive->setVilleArrive(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Escales[]
     */
    public function getEscalesDepart(): Collection
    {
        return $this->escalesDepart;
    }

    public function addEscalesDepart(Escales $escalesDepart): self
    {
        if (!$this->escalesDepart->contains($escalesDepart)) {
            $this->escalesDepart[] = $escalesDepart;
            $escalesDepart->setVilleDepart($this);
        }

        return $this;
    }

    public function removeEscalesDepart(Escales $escalesDepart): self
    {
        if ($this->escalesDepart->removeElement($escalesDepart)) {
            // set the owning side to null (unless already changed)
            if ($escalesDepart->getVilleDepart() === $this) {
                $escalesDepart->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Escales[]
     */
    public function getEscalesArrive(): Collection
    {
        return $this->escalesArrive;
    }

    public function addEscalesArrive(Escales $escalesArrive): self
    {
        if (!$this->escalesArrive->contains($escalesArrive)) {
            $this->escalesArrive[] = $escalesArrive;
            $escalesArrive->setVilleArrive($this);
        }

        return $this;
    }

    public function removeEscalesArrive(Escales $escalesArrive): self
    {
        if ($this->escalesArrive->removeElement($escalesArrive)) {
            // set the owning side to null (unless already changed)
            if ($escalesArrive->getVilleArrive() === $this) {
                $escalesArrive->setVilleArrive(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservationVilleDepart(): Collection
    {
        return $this->reservationVilleDepart;
    }

    public function addReservationVilleDepart(Reservation $reservationVilleDepart): self
    {
        if (!$this->reservationVilleDepart->contains($reservationVilleDepart)) {
            $this->reservationVilleDepart[] = $reservationVilleDepart;
            $reservationVilleDepart->setVilleDepart($this);
        }

        return $this;
    }

    public function removeReservationVilleDepart(Reservation $reservationVilleDepart): self
    {
        if ($this->reservationVilleDepart->removeElement($reservationVilleDepart)) {
            // set the owning side to null (unless already changed)
            if ($reservationVilleDepart->getVilleDepart() === $this) {
                $reservationVilleDepart->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservationVilleArrive(): Collection
    {
        return $this->reservationVilleArrive;
    }

    public function addReservationVilleArrive(Reservation $reservationVilleArrive): self
    {
        if (!$this->reservationVilleArrive->contains($reservationVilleArrive)) {
            $this->reservationVilleArrive[] = $reservationVilleArrive;
            $reservationVilleArrive->setVilleArrivee($this);
        }

        return $this;
    }

    public function removeReservationVilleArrive(Reservation $reservationVilleArrive): self
    {
        if ($this->reservationVilleArrive->removeElement($reservationVilleArrive)) {
            // set the owning side to null (unless already changed)
            if ($reservationVilleArrive->getVilleArrivee() === $this) {
                $reservationVilleArrive->setVilleArrivee(null);
            }
        }

        return $this;
    }
}
