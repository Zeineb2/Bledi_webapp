<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Idee
 *
 * @ORM\Table(name="idee")
 * @ORM\Entity
 */
class Idee
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_idee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIdee;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_idee", type="string", length=255, nullable=false)
     */
    private $typeIdee;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_idee", type="string", length=255, nullable=false)
     */
    private $descriptionIdee;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_idee", type="blob", length=65535, nullable=false)
     */
    private $imageIdee;

    public function getIdIdee(): ?int
    {
        return $this->idIdee;
    }

    public function getTypeIdee(): ?string
    {
        return $this->typeIdee;
    }

    public function setTypeIdee(string $typeIdee)
    {
        $this->typeIdee = $typeIdee;

        return $this;
    }

    public function getDescriptionIdee(): ?string
    {
        return $this->descriptionIdee;
    }

    public function setDescriptionIdee(string $descriptionIdee)
    {
        $this->descriptionIdee = $descriptionIdee;

        return $this;
    }

    public function getImageIdee()
    {
        return $this->imageIdee;
    }

    public function setImageIdee($imageIdee)
    {
        $this->imageIdee = $imageIdee;

        return $this;
    }


}
