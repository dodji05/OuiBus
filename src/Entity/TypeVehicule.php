<?php

namespace App\Entity;

use App\Repository\TypeVehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeVehiculeRepository::class)
 */
class TypeVehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbreSiege;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Status;

    /**
     * @ORM\OneToMany(targetEntity=EnregistrementVehicule::class, mappedBy="TypeVehicule")
     *
     */
    private $enregistrementVehicules;

    public function __construct()
    {
        $this->enregistrementVehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbreSiege(): ?int
    {
        return $this->NbreSiege;
    }

    public function setNbreSiege(?int $NbreSiege): self
    {
        $this->NbreSiege = $NbreSiege;

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
     * @return Collection|EnregistrementVehicule[]
     */
    public function getEnregistrementVehicules(): Collection
    {
        return $this->enregistrementVehicules;
    }

    public function addEnregistrementVehicule(EnregistrementVehicule $enregistrementVehicule): self
    {
        if (!$this->enregistrementVehicules->contains($enregistrementVehicule)) {
            $this->enregistrementVehicules[] = $enregistrementVehicule;
            $enregistrementVehicule->setTypeVehicule($this);
        }

        return $this;
    }

    public function removeEnregistrementVehicule(EnregistrementVehicule $enregistrementVehicule): self
    {
        if ($this->enregistrementVehicules->removeElement($enregistrementVehicule)) {
            // set the owning side to null (unless already changed)
            if ($enregistrementVehicule->getTypeVehicule() === $this) {
                $enregistrementVehicule->setTypeVehicule(null);
            }
        }

        return $this;
    }
}
