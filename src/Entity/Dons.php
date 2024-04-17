<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dons
 *
 * @ORM\Table(name="dons", indexes={@ORM\Index(name="id_com", columns={"id_com"})})
 * @ORM\Entity
 */
class Dons
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_don", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDon;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_don", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantDon;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_don", type="string", length=255, nullable=false)
     */
    private $mailDon;

    /**
     * @var int
     *
     * @ORM\Column(name="CIN_don", type="integer", nullable=false)
     */
    private $cinDon;

    /**
     * @var string
     *
     * @ORM\Column(name="virement_img", type="text", length=65535, nullable=false)
     */
    private $virementImg;

    /**
     * @var \CompagneDons
     *
     * @ORM\ManyToOne(targetEntity="CompagneDons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_com", referencedColumnName="id_com")
     * })
     */
    private $idCom;


}
