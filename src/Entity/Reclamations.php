<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idRec;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorieId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisationRec;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionRec;

    /**
     * @ORM\Column(type="blob")
     */
    private $imgRec;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cinCit;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Solutions::class, mappedBy="idRec")
     */
    private $solutions;

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
