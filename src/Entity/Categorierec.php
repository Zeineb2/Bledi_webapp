<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorierec
 *
 * @ORM\Table(name="categorierec")
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
    private $categorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }


}
