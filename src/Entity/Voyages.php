<?php

namespace App\Entity;

use App\Repository\VoyagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoyagesRepository::class)
 */
class Voyages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateDepart;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $HeureDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Lignes::class, inversedBy="voyages")
     */
    private $ligne;

    /**
     * @ORM\ManyToOne(targetEntity=EnregistrementVehicule::class, inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Status;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="voyage")
     */
    private $reservations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomVoyages;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->DateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $DateDepart): self
    {
        $this->DateDepart = $DateDepart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->HeureDepart;
    }

    public function setHeureDepart(?\DateTimeInterface $HeureDepart): self
    {
        $this->HeureDepart = $HeureDepart;

        return $this;
    }

    public function getLigne(): ?Lignes
    {
        return $this->ligne;
    }

    public function setLigne(?Lignes $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }

    public function getBus(): ?EnregistrementVehicule
    {
        return $this->bus;
    }

    public function setBus(?EnregistrementVehicule $bus): self
    {
        $this->bus = $bus;

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
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setVoyage($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getVoyage() === $this) {
                $reservation->setVoyage(null);
            }
        }

        return $this;
    }

    public function getNomVoyages(): ?string
    {
        return $this->NomVoyages;
    }

    public function setNomVoyages(?string $NomVoyages): self
    {
        $this->NomVoyages = $NomVoyages;

        return $this;
    }
}
