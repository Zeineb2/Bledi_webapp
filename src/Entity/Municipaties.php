<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipaties
 *
 * @ORM\Table(name="municipaties")
 * @ORM\Entity
 */
class Municipaties
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_muni", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMuni;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_muni", type="string", length=255, nullable=false)
     */
    private $nomMuni;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_muni", type="string", length=255, nullable=false)
     */
    private $adresseMuni;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_muni", type="string", length=255, nullable=false)
     */
    private $etatMuni;

    /**
     * @var float
     *
     * @ORM\Column(name="rating_muni", type="float", precision=10, scale=0, nullable=false)
     */
    private $ratingMuni;

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


}
