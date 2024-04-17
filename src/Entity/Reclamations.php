<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="categorie_id", columns={"categorie_id", "CIN_cit"}), @ORM\Index(name="IDX_1CAD6B76BCF5E72D", columns={"categorie_id"})})
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
    public $idRec;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_rec", type="string", length=255, nullable=false)
     */
    public $localisationRec;

    /**
     * @var string
     *
     * @ORM\Column(name="description_rec", type="string", length=255, nullable=false)
     */
    public $descriptionRec;

    /**
     * @var string
     *
     * @ORM\Column(name="img_rec", type="string", length=255, nullable=false)
     */
    public $imgRec;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    public $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CIN_cit", type="integer", nullable=true)
     */
    public $cinCit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    public $date;

    /**
     * @var \Categorierec
     *
     * @ORM\ManyToOne(targetEntity="Categorierec")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="categorie_id")
     * })
     */
    public $categorie;
    public function __toString():string 
    {
        return $this->descriptionRec;
    }
    public function getPhoto(): ?string
    {
        return $this->imgRec;
    }

    public function setPhoto(string $photo)
    {
        $this->imgRec = $photo;

        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->descriptionRec;
    }

    public function setDate(\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }


}
