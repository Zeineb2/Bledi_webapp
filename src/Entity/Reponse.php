<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="id_reclamation", columns={"id_reclamation"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reponse", type="date", nullable=false)
     */
    public $dateReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    public $message;

    /**
     * @var \Reclamations
     *
     * @ORM\ManyToOne(targetEntity="Reclamations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reclamation", referencedColumnName="ID_rec")
     * })
     */
    public $idReclamation;
    public function getDate(): ?\DateTimeInterface
    {
        return $this->dateReponse;
    }

    public function setDate(\DateTimeInterface $date)
    {
        $this->dateReponse = $date;

        return $this;
    }
    public function getReclamations(): ?\Reclamations
    {
        return $this->idReclamation;
    }

    public function setReclamations(Reclamations $idReclamation)
    {
        $this->idReclamation = $idReclamation;

        return $this;
    }


}
