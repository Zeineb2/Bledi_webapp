<?php

namespace App\Entity;

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


}
