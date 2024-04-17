<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations", indexes={@ORM\Index(name="FK_ID_event", columns={"ID_event"})})
 * @ORM\Entity
 */
class Reservations
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_res", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRes;

    /**
     * @var int
     *
     * @ORM\Column(name="CIN_res", type="integer", nullable=false)
     */
    private $cinRes;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=200, nullable=false)
     */
    private $commentaire;

    /**
     * @var \Evenements
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_event", referencedColumnName="ID_event")
     * })
     */
    private $idEvent;


}
