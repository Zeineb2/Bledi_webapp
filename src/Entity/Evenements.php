<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 *
 * @ORM\Table(name="evenements")
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=255, nullable=false)
     */
    private $nomEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_event", type="string", length=255, nullable=false)
     */
    private $categorieEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="description_event", type="string", length=255, nullable=false)
     */
    private $descriptionEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbp_event", type="integer", nullable=false)
     */
    private $nbpEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateD_event", type="date", nullable=false)
     */
    private $datedEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateF_event", type="date", nullable=false)
     */
    private $datefEvent;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getCategorieEvent(): ?string
    {
        return $this->categorieEvent;
    }

    public function setCategorieEvent(string $categorieEvent)
    {
        $this->categorieEvent = $categorieEvent;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->descriptionEvent;
    }

    public function setDescriptionEvent(string $descriptionEvent)
    {
        $this->descriptionEvent = $descriptionEvent;

        return $this;
    }

    public function getNbpEvent(): ?int
    {
        return $this->nbpEvent;
    }

    public function setNbpEvent(int $nbpEvent)
    {
        $this->nbpEvent = $nbpEvent;

        return $this;
    }

    public function getDatedEvent(): ?\DateTimeInterface
    {
        return $this->datedEvent;
    }

    public function setDatedEvent(\DateTimeInterface $datedEvent)
    {
        $this->datedEvent = $datedEvent;

        return $this;
    }

    public function getDatefEvent(): ?\DateTimeInterface
    {
        return $this->datefEvent;
    }

    public function setDatefEvent(\DateTimeInterface $datefEvent)
    {
        $this->datefEvent = $datefEvent;

        return $this;
    }


}
