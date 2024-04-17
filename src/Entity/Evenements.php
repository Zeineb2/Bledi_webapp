<?php

namespace App\Entity;

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


}
