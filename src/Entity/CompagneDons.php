<?php

namespace App\Entity;

use App\Repository\CompagneDonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagneDonsRepository::class)]
class CompagneDons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $date_d = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTimeInterface $date_f = null;

    #[ORM\Column]
    public ?float $montant_e = null;

    #[ORM\Column(length: 255)]
    private ?string $descrip = null;

    #[ORM\OneToMany(targetEntity: Dons::class, mappedBy: 'compagne', orphanRemoval: true)]
    private Collection $dons;

    #[ORM\ManyToOne(inversedBy: 'compagneDons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Municipaties $muni = null;

    public function __construct()
    {
        $this->dons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->date_d;
    }

    public function setDateD(\DateTimeInterface $date_d): static
    {
        $this->date_d = $date_d;

        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->date_f;
    }

    public function setDateF(\DateTimeInterface $date_f): static
    {
        $this->date_f = $date_f;

        return $this;
    }

    public function getMontantE(): ?float
    {
        return $this->montant_e;
    }

    public function setMontantE(float $montant_e): static
    {
        $this->montant_e = $montant_e;

        return $this;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip): static
    {
        $this->descrip = $descrip;

        return $this;
    }

    /**
     * @return Collection<int, Dons>
     */
    public function getDons(): Collection
    {
        return $this->dons;
    }

    public function addDon(Dons $don): static
    {
        if (!$this->dons->contains($don)) {
            $this->dons->add($don);
            $don->setCompagne($this);
        }

        return $this;
    }

    public function removeDon(Dons $don): static
    {
        if ($this->dons->removeElement($don)) {
            // set the owning side to null (unless already changed)
            if ($don->getCompagne() === $this) {
                $don->setCompagne(null);
            }
        }

        return $this;
    }

    public function getMuni(): ?Municipaties
    {
        return $this->muni;
    }

    public function setMuni(?Municipaties $muni): static
    {
        $this->muni = $muni;

        return $this;
    }
}
