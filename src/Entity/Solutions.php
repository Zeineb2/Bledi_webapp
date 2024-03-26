<?php

namespace App\Entity;

use App\Repository\SolutionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolutionsRepository::class)]
class Solutions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ID_sol = null;

    #[ORM\Column(nullable: true)]
    private ?int $ID_rec = null;

    #[ORM\Column(length: 255)]
    private ?string $description_sol = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateD_sol = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateF_sol = null;

    #[ORM\Column(length: 255)]
    private ?string $etat_sol = null;

    #[ORM\Column]
    private ?float $budget_sol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDSol(): ?int
    {
        return $this->ID_sol;
    }

    public function setIDSol(int $ID_sol): static
    {
        $this->ID_sol = $ID_sol;

        return $this;
    }

    public function getIDRec(): ?int
    {
        return $this->ID_rec;
    }

    public function setIDRec(?int $ID_rec): static
    {
        $this->ID_rec = $ID_rec;

        return $this;
    }

    public function getDescriptionSol(): ?string
    {
        return $this->description_sol;
    }

    public function setDescriptionSol(string $description_sol): static
    {
        $this->description_sol = $description_sol;

        return $this;
    }

    public function getDateDSol(): ?\DateTimeInterface
    {
        return $this->dateD_sol;
    }

    public function setDateDSol(\DateTimeInterface $dateD_sol): static
    {
        $this->dateD_sol = $dateD_sol;

        return $this;
    }

    public function getDateFSol(): ?\DateTimeInterface
    {
        return $this->dateF_sol;
    }

    public function setDateFSol(\DateTimeInterface $dateF_sol): static
    {
        $this->dateF_sol = $dateF_sol;

        return $this;
    }

    public function getEtatSol(): ?string
    {
        return $this->etat_sol;
    }

    public function setEtatSol(string $etat_sol): static
    {
        $this->etat_sol = $etat_sol;

        return $this;
    }

    public function getBudgetSol(): ?float
    {
        return $this->budget_sol;
    }

    public function setBudgetSol(float $budget_sol): static
    {
        $this->budget_sol = $budget_sol;

        return $this;
    }
}
