<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ressources
 *
 * @ORM\Table(name="ressources", indexes={@ORM\Index(name="FK_ID_muni", columns={"ID_muni"})})
 * @ORM\Entity
 */
class Ressources
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ressource", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRessource;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ressource", type="string", length=255, nullable=false)
     */
    private $nomRessource;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_ressource", type="integer", nullable=false)
     */
    private $nbrRessource;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_dispo_ressource", type="integer", nullable=false)
     */
    private $nbrDispoRessource;

    /**
     * @var string
     *
     * @ORM\Column(name="img_ressource", type="string", length=10000, nullable=false)
     */
    private $imgRessource;

    /**
     * @var \Municipaties
     *
     * @ORM\ManyToOne(targetEntity="Municipaties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_muni", referencedColumnName="ID_muni")
     * })
     */
    private $idMuni;

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
