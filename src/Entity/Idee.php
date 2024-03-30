<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass:IdeeRepository::class)]

class Idee
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "ID_idee", type: "integer", nullable: false)]
    private ?int $idIdee;

    #[ORM\Column(name: "Type_idee", type: "string", length: 255, nullable: false)]
    private ?string $typeIdee;

    #[ORM\Column(name: "Description_idee", type: "string", length: 255, nullable: false)]
    private ?string $descriptionIdee;

    #[ORM\Column(name: "Image_idee", type: "blob", length: 65535, nullable: false)]
    private $imageIdee;

    public function getIdIdee(): ?int
    {
        return $this->idIdee;
    }

    public function getTypeIdee(): ?string
    {
        return $this->typeIdee;
    }

    public function setTypeIdee(string $typeIdee): static
    {
        $this->typeIdee = $typeIdee;
        return $this;
    }

    public function getDescriptionIdee(): ?string
    {
        return $this->descriptionIdee;
    }

    public function setDescriptionIdee(string $descriptionIdee): static
    {
        $this->descriptionIdee = $descriptionIdee;
        return $this;
    }

    public function getImageIdee()
    {
        return $this->imageIdee;
    }

    public function setImageIdee($imageIdee): static
    {
        $this->imageIdee = $imageIdee;
        return $this;
    }
}


