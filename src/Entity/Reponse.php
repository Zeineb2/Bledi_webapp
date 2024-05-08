<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    public $id;

    #[ORM\Column(name: "date_reponse", type: "date", nullable: false)]
    public $dateReponse;

    #[ORM\Column(name: "message", type: "string", length: 255, nullable: false)]
    public $message;

    #[ORM\ManyToOne(targetEntity: "Reclamations")]
    #[ORM\JoinColumn(name: "id_reclamation", referencedColumnName: "ID_rec")]
    public $idReclamation;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->dateReponse;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->dateReponse = $date;

        return $this;
    }

    public function getReclamations(): ?Reclamations
    {
        return $this->idReclamation;
    }

    public function setReclamations(Reclamations $idReclamation): static
    {
        $this->idReclamation = $idReclamation;

        return $this;
    }
}