<?php

namespace App\Entity;

use App\Repository\DonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DonsRepository::class)]
class Dons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le montant du don ne peut pas être vide.")]
    #[Assert\GreaterThan(value: 0, message: "Le montant du don doit être supérieur à zéro.")]
    private ?float $montant_don = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'adresse email ne peut pas être vide.")]
    #[Assert\Email(message: "L'adresse email '{{ value }}' n'est pas valide.")]
    private ?string $mail_don = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le CIN ne peut pas être vide.")]
    #[Assert\Length(
        min: 8,
        max: 8,
        exactMessage: "Le CIN doit être composé de 8 chiffres."
    )]
    private ?int $CIN_don = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $virement_img = null;

    #[ORM\ManyToOne(inversedBy: 'dons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompagneDons $compagne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantDon(): ?float
    {
        return $this->montant_don;
    }

    public function setMontantDon(float $montant_don): self
    {
        $this->montant_don = $montant_don;
        return $this;
    }

    public function getMailDon(): ?string
    {
        return $this->mail_don;
    }

    public function setMailDon(string $mail_don): self
    {
        $this->mail_don = $mail_don;
        return $this;
    }

    public function getCINDon(): ?int
    {
        return $this->CIN_don;
    }

    public function setCINDon(int $CIN_don): self
    {
        $this->CIN_don = $CIN_don;
        return $this;
    }

    public function getVirementImg(): ?string
    {
        return $this->virement_img;
    }

    public function setVirementImg(string $virement_img): self
    {
        $this->virement_img = $virement_img;
        return $this;
    }

    public function getCompagne(): ?CompagneDons
    {
        return $this->compagne;
    }

    public function setCompagne(?CompagneDons $compagne): self
    {
        $this->compagne = $compagne;
        return $this;
    }
}
