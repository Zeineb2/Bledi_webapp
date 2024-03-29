<?php

namespace App\Entity;

use App\Repository\MunicipatiesRepository;
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
