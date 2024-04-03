<?php

namespace App\Entity;

use App\Repository\MunicipatiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MunicipatiesRepository::class)]
class Municipaties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idMuni = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMuni = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseMuni = null;

    #[ORM\Column(length: 255)]
    private ?string $etatMuni = null;

    #[ORM\Column]
    private ?float $ratingMuni = null;

    #[ORM\OneToMany(mappedBy: 'idMuni', targetEntity: Ressources::class, orphanRemoval: true)]
    private Collection $ressources;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
    }


    public function getIdMuni(): ?int
    {
        return $this->idMuni;
    }

    public function getNomMuni(): ?string
    {
        return $this->nomMuni;
    }

    public function setNomMuni(string $nomMuni)
    {
        $this->nomMuni = $nomMuni;

        return $this;
    }

    public function getAdresseMuni(): ?string
    {
        return $this->adresseMuni;
    }

    public function setAdresseMuni(string $adresseMuni)
    {
        $this->adresseMuni = $adresseMuni;

        return $this;
    }

    public function getEtatMuni(): ?string
    {
        return $this->etatMuni;
    }

    public function setEtatMuni(string $etatMuni)
    {
        $this->etatMuni = $etatMuni;

        return $this;
    }

    public function getRatingMuni(): ?float
    {
        return $this->ratingMuni;
    }

    public function setRatingMuni(float $ratingMuni)
    {
        $this->ratingMuni = $ratingMuni;

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setIdMuni($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getIdMuni() === $this) {
                $ressource->setIdMuni(null);
            }
        }

        return $this;
    }

   


}
