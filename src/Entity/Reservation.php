<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Voyages::class, inversedBy="reservations")
     */
    private $voyage;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="reservationVilleDepart")
     */
    private $VilleDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="reservationVilleArrive")
     */
    private $VilleArrivee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumeroSiege;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrePlace;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $StatusPayement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateReservation;

   

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->DateReservation = new \DateTime();
        $this->StatusPayement = "no";
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoyage(): ?Voyages
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyages $voyage): self
    {
        $this->voyage = $voyage;

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

    public function getVilleArrivee(): ?Ville
    {
        return $this->VilleArrivee;
    }

    public function setVilleArrivee(?Ville $VilleArrivee): self
    {
        $this->VilleArrivee = $VilleArrivee;

        return $this;
    }

    public function getNumeroSiege(): ?string
    {
        return $this->NumeroSiege;
    }

    public function setNumeroSiege(?string $NumeroSiege): self
    {
        $this->NumeroSiege = $NumeroSiege;

        return $this;
    }

    public function getNbrePlace(): ?int
    {
        return $this->NbrePlace;
    }

    public function setNbrePlace(?int $NbrePlace): self
    {
        $this->NbrePlace = $NbrePlace;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getStatusPayement(): ?string
    {
        return $this->StatusPayement;
    }

    public function setStatusPayement(string $StatusPayement): self
    {
        $this->StatusPayement = $StatusPayement;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->DateReservation;
    }

    public function setDateReservation(?\DateTimeInterface $DateReservation): self
    {
        $this->DateReservation = $DateReservation;

        return $this;
    }

   
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
