<?php

namespace App\Entity;

use App\Repository\SolutionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;





#[ORM\Entity(repositoryClass:SolutionsRepository::class)]
class Solutions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idSol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionSol = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $datedSol = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $datefSol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etatSol = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $budgetSol = null;

  /*  #[ORM\ManyToOne(targetEntity: Reclamations::class)]
    #[ORM\JoinColumn(name: 'ID_rec', referencedColumnName: 'ID_rec' ,nullable: true)]*/
    #[ORM\Column( type: "integer", nullable: false)]
    private /*?Reclamations*/ ?int $idRec = null;

    public function getIdSol(): ?int
    {
        return $this->idSol;
    }

    public function getDescriptionSol(): ?string
    {
        return $this->descriptionSol;
    }

    public function setDescriptionSol(string $descriptionSol)
    {
        $this->descriptionSol = $descriptionSol;

        return $this;
    }

    public function getDatedSol(): ?\DateTimeInterface
    {
        return $this->datedSol;
    }

    public function setDatedSol(\DateTimeInterface $datedSol)
    {
        $this->datedSol = $datedSol;

        return $this;
    }

    public function getDatefSol(): ?\DateTimeInterface
    {
        return $this->datefSol;
    }

    public function setDatefSol(\DateTimeInterface $datefSol)
    {
        $this->datefSol = $datefSol;

        return $this;
    }

    public function getEtatSol(): ?string
    {
        return $this->etatSol;
    }

    public function setEtatSol(string $etatSol)
    {
        $this->etatSol = $etatSol;

        return $this;
    }

    public function getBudgetSol(): ?float
    {
        return $this->budgetSol;
    }

    public function setBudgetSol(float $budgetSol)
    {
        $this->budgetSol = $budgetSol;

        return $this;
    }

    public function getIdRec(): ?Reclamations
    {
        return $this->idRec;
    }

    public function setIdRec(?Reclamations $idRec)
    {
        $this->idRec = $idRec;

        return $this;
    }

    // Remove setIdSol method

}
