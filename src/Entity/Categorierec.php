<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Categorierec
{
    #[ORM\Column(name: "categorie_id", type: "integer", nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    public $categorieId;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: false)]
    public $name;

    #[ORM\Column(name: "priority", type: "integer", nullable: false)]
    public $priority;

    public function __toString(): string
    {
        return $this->name;
    }
}
