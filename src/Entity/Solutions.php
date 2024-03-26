<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Solutions
 *
 * @ORM\Table(name="solutions", indexes={@ORM\Index(name="FK_ID_rec", columns={"ID_rec"})})
 * @ORM\Entity
 */
class Solutions
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_sol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSol;

    /**
     * @var string
     *
     * @ORM\Column(name="description_sol", type="string", length=255, nullable=false)
     */
    private $descriptionSol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateD_sol", type="date", nullable=false)
     */
    private $datedSol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateF_sol", type="date", nullable=false)
     */
    private $datefSol;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_sol", type="string", length=255, nullable=false)
     */
    private $etatSol;

    /**
     * @var float
     *
     * @ORM\Column(name="budget_sol", type="float", precision=10, scale=0, nullable=false)
     */
    private $budgetSol;

    /**
     * @var \Reclamations
     *
     * @ORM\ManyToOne(targetEntity="Reclamations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_rec", referencedColumnName="ID_rec")
     * })
     */
    private $idRec;

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


}
