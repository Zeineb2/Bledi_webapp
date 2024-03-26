<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
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

    public function getIdDon(): ?int
    {
        return $this->idDon;
    }

    public function getMontantDon(): ?float
    {
        return $this->montantDon;
    }

    public function setMontantDon(float $montantDon)
    {
        $this->montantDon = $montantDon;

        return $this;
    }

    public function getMailDon(): ?string
    {
        return $this->mailDon;
    }

    public function setMailDon(string $mailDon)
    {
        $this->mailDon = $mailDon;

        return $this;
    }

    public function getCinDon(): ?int
    {
        return $this->cinDon;
    }

    public function setCinDon(int $cinDon)
    {
        $this->cinDon = $cinDon;

        return $this;
    }

    public function getVirementImg(): ?string
    {
        return $this->virementImg;
    }

    public function setVirementImg(string $virementImg)
    {
        $this->virementImg = $virementImg;

        return $this;
    }

    public function getIdCom(): ?CompagneDons
    {
        return $this->idCom;
    }

    public function setIdCom(?CompagneDons $idCom)
    {
        $this->idCom = $idCom;

        return $this;
    }


}
