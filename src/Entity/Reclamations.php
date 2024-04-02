<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="categorie_id", columns={"categorie_id", "CIN_cit"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var int
     *
     * @ORM\Column(name="categorie_id", type="integer", nullable=false)
     */
    private $categorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_rec", type="string", length=255, nullable=false)
     */
    private $localisationRec;

    /**
     * @var string
     *
     * @ORM\Column(name="description_rec", type="string", length=255, nullable=false)
     */
    private $descriptionRec;

    /**
     * @var string
     *
     * @ORM\Column(name="img_rec", type="blob", length=65535, nullable=false)
     */
    private $imgRec;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CIN_cit", type="integer", nullable=true)
     */
    private $cinCit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    public function getIdRec(): ?int
    {
        return $this->idRec;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function setCategorieId(int $categorieId)
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    public function getLocalisationRec(): ?string
    {
        return $this->localisationRec;
    }

    public function setLocalisationRec(string $localisationRec)
    {
        $this->localisationRec = $localisationRec;

        return $this;
    }

    public function getDescriptionRec(): ?string
    {
        return $this->descriptionRec;
    }

    public function setDescriptionRec(string $descriptionRec)
    {
        $this->descriptionRec = $descriptionRec;

        return $this;
    }

    public function getImgRec()
    {
        return $this->imgRec;
    }

    public function setImgRec($imgRec)
    {
        $this->imgRec = $imgRec;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    public function getCinCit(): ?int
    {
        return $this->cinCit;
    }

    public function setCinCit(?int $cinCit)
    {
        $this->cinCit = $cinCit;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }


}
