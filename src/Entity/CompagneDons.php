<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompagneDons
 *
 * @ORM\Table(name="compagne_dons", indexes={@ORM\Index(name="ID_muni", columns={"ID_muni"})})
 * @ORM\Entity
 */
class CompagneDons
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_com", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var string
     *
     * @ORM\Column(name="date_d", type="string", length=250, nullable=false)
     */
    private $dateD;

    /**
     * @var string
     *
     * @ORM\Column(name="date_f", type="string", length=250, nullable=false)
     */
    private $dateF;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_e", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantE;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip", type="string", length=255, nullable=false)
     */
    private $descrip;

    /**
     * @var \Municipaties
     *
     * @ORM\ManyToOne(targetEntity="Municipaties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_muni", referencedColumnName="ID_muni")
     * })
     */
    private $idMuni;

    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function getDateD(): ?string
    {
        return $this->dateD;
    }

    public function setDateD(string $dateD)
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function getDateF(): ?string
    {
        return $this->dateF;
    }

    public function setDateF(string $dateF)
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getMontantE(): ?float
    {
        return $this->montantE;
    }

    public function setMontantE(float $montantE)
    {
        $this->montantE = $montantE;

        return $this;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip)
    {
        $this->descrip = $descrip;

        return $this;
    }

    public function getIdMuni(): ?Municipaties
    {
        return $this->idMuni;
    }

    public function setIdMuni(?Municipaties $idMuni)
    {
        $this->idMuni = $idMuni;

        return $this;
    }


}