<?php

namespace App\Entity;

use App\Repository\MunicipatiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MunicipatiesRepository::class)]
class Municipaties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Municipality name cannot be blank")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z\s]+$/",
        message: "Invalid name format. Only letters and spaces are allowed."
    )]
    private ?string $nomMuni = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Address cannot be blank")]
    private ?string $adresseMuni = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "State cannot be blank")]
    private ?string $etatMuni = null;

    #[ORM\Column]
    private ?float $ratingMuni = 0.0;

    #[ORM\OneToMany(mappedBy: 'IDMuni', targetEntity: Ressources::class )]
    private Collection $ressources;

    #[ORM\OneToMany(targetEntity: CompagneDons::class, mappedBy: 'muni', orphanRemoval: true)]
    private Collection $compagneDons;


    public function __construct()
    {
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->nomMuni; // Adjust this according to how you want to represent the entity as a string
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
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setIDMuni($this);
        }

        return $this;
    }

    public function removeCompagneDon(CompagneDons $compagneDon): static
    {
        if ($this->compagneDons->removeElement($compagneDon)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getIDMuni() === $this) {
                $ressource->setIDMuni(null);
            }
        }

        return $this;
    }

}
