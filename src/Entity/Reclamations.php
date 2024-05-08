<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Reclamations
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "ID_rec", type: "integer", nullable: false)]
    public $idRec;

    #[ORM\Column(name: "localisation_rec", type: "string", length: 255, nullable: false)]
    public $localisationRec;

    #[ORM\Column(name: "description_rec", type: "string", length: 255, nullable: false)]
    public $descriptionRec;

    #[ORM\Column(name: "img_rec", type: "string", length: 255, nullable: false)]
    public $imgRec;

    #[ORM\Column(name: "status", type: "string", length: 255, nullable: false)]
    public $status;

    #[ORM\Column(name: "CIN_cit", type: "integer", nullable: true)]
    public $cinCit;

    #[ORM\Column(name: "date", type: "date", nullable: false)]
    public $date;

    #[ORM\ManyToOne(targetEntity: "Categorierec")]
    #[ORM\JoinColumn(name: "categorie_id", referencedColumnName: "categorie_id")]
    public $categorie;

    public function __toString(): string
    {
        return $this->descriptionRec;
    }

    public function getPhoto(): ?string
    {
        return $this->imgRec;
    }

    public function setPhoto(string $photo): static
    {
        $this->imgRec = $photo;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
