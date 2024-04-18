<?php

namespace App\Entity;

use App\Repository\MunicipatiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MunicipatiesRepository::class)]
class Municipaties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_muni = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_muni = null;

    #[ORM\Column(length: 255)]
    private ?string $etat_muni = null;

    #[ORM\OneToMany(targetEntity: CompagneDons::class, mappedBy: 'muni', orphanRemoval: true)]
    private Collection $compagneDons;

    public function __construct()
    {
        $this->compagneDons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMuni(): ?string
    {
        return $this->nom_muni;
    }

    public function setNomMuni(string $nom_muni): static
    {
        $this->nom_muni = $nom_muni;

        return $this;
    }

    public function getAdresseMuni(): ?string
    {
        return $this->adresse_muni;
    }

    public function setAdresseMuni(string $adresse_muni): static
    {
        $this->adresse_muni = $adresse_muni;

        return $this;
    }

    public function getEtatMuni(): ?string
    {
        return $this->etat_muni;
    }

    public function setEtatMuni(string $etat_muni): static
    {
        $this->etat_muni = $etat_muni;

        return $this;
    }

    /**
     * @return Collection<int, CompagneDons>
     */
    public function getCompagneDons(): Collection
    {
        return $this->compagneDons;
    }

    public function addCompagneDon(CompagneDons $compagneDon): static
    {
        if (!$this->compagneDons->contains($compagneDon)) {
            $this->compagneDons->add($compagneDon);
            $compagneDon->setMuni($this);
        }

        return $this;
    }

    public function removeCompagneDon(CompagneDons $compagneDon): static
    {
        if ($this->compagneDons->removeElement($compagneDon)) {
            // set the owning side to null (unless already changed)
            if ($compagneDon->getMuni() === $this) {
                $compagneDon->setMuni(null);
            }
        }

        return $this;
    }
}
