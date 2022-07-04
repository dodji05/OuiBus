<?php

namespace App\Entity;

use App\Repository\EscalesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EscalesRepository::class)
 */
class Escales
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
    private $NomEscale;

    /**
     * @ORM\ManyToOne(targetEntity=Lignes::class, inversedBy="escales")
     */
    private $ligne;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="escalesDepart")
     */
    private $VilleDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="escalesArrive")
     */
    private $VilleArrive;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEscale(): ?string
    {
        return $this->NomEscale;
    }

    public function setNomEscale(?string $NomEscale): self
    {
        $this->NomEscale = $NomEscale;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
