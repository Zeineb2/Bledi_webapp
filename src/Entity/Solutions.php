<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solutions
 *
 * @ORM\Table(name="solutions")
 * @ORM\Entity
 */
class Solutions
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_sol", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSol;

    /**
     * @var string
     *
     * @ORM\Column(name="description_sol", type="string", length=255, nullable=false)
     */
    private $descriptionSol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateD_sol", type="date", nullable=false)
     */
    private $datedSol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateF_sol", type="date", nullable=false)
     */
    private $datefSol;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_sol", type="string", length=255, nullable=false)
     */
    private $etatSol;

    /**
     * @var float
     *
     * @ORM\Column(name="budget_sol", type="float", precision=10, scale=0, nullable=false)
     */
    private $budgetSol;


}
