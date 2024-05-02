<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
#[Vich\Uploadable]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idRessource = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ressource name cannot be blank")]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z0-9\s]+$/",
        message: "Invalid name format. Only letters , numbers and spaces are allowed."
    )]
    private ?string $nomRessource = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Ressource number cannot be blank")]
    #[Assert\Regex(
        pattern: "/^[1-9]\d*$/",
        message: "Invalid number format. Only positive numbers are allowed."
    )]
    private ?int $nbrRessource = null;


    #[ORM\Column]
    private ?int $nbrDispoRessource = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Ressource image cannot be blank")]
    private ?string $imgRessource = null;

    #[ORM\ManyToOne(inversedBy: 'ressources')]
    #[ORM\JoinColumn(name: 'ID_muni', referencedColumnName: 'id')]
    #[Assert\NotBlank(message: "this field cannot be blank")]
    private ?Municipaties $IDMuni = null;
    
    #[Vich\UploadableField(mapping: 'ressources_images', fileNameProperty: 'imgRessource')]
    private ?File $imageFile = null;
    
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    
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
        $this->nbrDispoRessource = $nbrRessource;

        return $this;
    }

    public function getNbrDispoRessource(): ?int
    {
        return $this->nbrDispoRessource;
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

    public function getIDMuni(): ?Municipaties
    {
        return $this->IDMuni;
    }

    public function setIDMuni(?Municipaties $IDMuni): static
    {
        $this->IDMuni = $IDMuni;

        return $this;
    }
}
