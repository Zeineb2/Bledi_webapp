<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorierec
 *
 * @ORM\Table(name="categorierec", indexes={@ORM\Index(name="categorie_id", columns={"categorie_id"})})
 * @ORM\Entity
 */
class Categorierec
{
    /**
     * @var int
     *
     * @ORM\Column(name="categorie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $categorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    public $priority;
    public function __toString():string 
    {
        return $this->name;
    }


}
