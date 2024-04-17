<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ressources
 *
 * @ORM\Table(name="ressources", indexes={@ORM\Index(name="FK_ID_muni", columns={"ID_muni"})})
 * @ORM\Entity
 */
class Ressources
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_rec", type="string", length=255, nullable=false)
     */
    private $categorieRec;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_rec", type="string", length=255, nullable=false)
     */
    private $localisationRec;

    /**
     * @var string
     *
     * @ORM\Column(name="description_rec", type="string", length=255, nullable=false)
     */
    private $descriptionRec;

    /**
     * @var string
     *
     * @ORM\Column(name="img_rec", type="string", length=30, nullable=false)
     */
    private $imgRec;

    /**
     * @var \Municipaties
     *
     * @ORM\ManyToOne(targetEntity="Municipaties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_muni", referencedColumnName="ID_muni")
     * })
     */
    private $idMuni;


}
