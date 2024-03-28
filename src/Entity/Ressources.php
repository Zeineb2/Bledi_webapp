<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]

class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idRessource = null;

    #[ORM\Column(length: 255)]
    private ?string $nomRessource = null;

    #[ORM\Column]
    private ?int $nbrRessource = null;


    #[ORM\Column]
    private ?int $nbrDispoRessource = null;


    #[ORM\Column(length: 255)]
    private ?string $imgRessource = null;


    #[ORM\ManyToOne(inversedBy: 'Municipaties')]
    private ?Municipaties $idMuni = null;

    public function getIdRessource(): ?int
    {
        return $this->idRessource;
    }

    public function getNomRessource(): ?string
    {
        return $this->nomRessource;
    }

    public function setNomRessource(string $nomRessource)
    {
        $this->nomRessource = $nomRessource;

        return $this;
    }

    public function getNbrRessource(): ?int
    {
        return $this->nbrRessource;
    }

    public function setNbrRessource(int $nbrRessource)
    {
        $this->nbrRessource = $nbrRessource;

        return $this;
    }

    public function getNbrDispoRessource(): ?int
    {
        return $this->nbrDispoRessource;
    }

    public function setNbrDispoRessource(int $nbrDispoRessource)
    {
        $this->nbrDispoRessource = $nbrDispoRessource;

        return $this;
    }

    public function getImgRessource(): ?string
    {
        return $this->imgRessource;
    }

    public function setImgRessource(string $imgRessource)
    {
        $this->imgRessource = $imgRessource;

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
