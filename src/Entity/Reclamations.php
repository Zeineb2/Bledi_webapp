<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:ReclamationsRepository::class)]
class Reclamations
{

     #[ORM\Id]
     #[ORM\GeneratedValue(strategy: "IDENTITY")]
     #[ORM\Column(name: "ID_rec", type: "integer", nullable: false)]
     private ?int $idRec;


    #[ORM\Column(name: "categorieId", type: "integer", nullable: false)]
    private $categorieId;

    #[ORM\Column(name: "localisationRec", type: "string", length: 255, nullable: false)]
    private $localisationRec;

    #[ORM\Column(name: "descriptionRec", type: "string", length: 255, nullable: false)]
    private $descriptionRec;

    #[ORM\Column(name: "imgRec", type: "blob", length: 65535, nullable: false)]
    private $imgRec;

    #[ORM\Column(name: "status", type: "string", length: 255, nullable: false)]
    private $status;

    #[ORM\Column(name: "cinCit", type: "integer", nullable: false)]
    private $cinCit;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;


    #[ORM\OneToMany(targetEntity: Solutions::class, mappedBy: "idRec")]
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
