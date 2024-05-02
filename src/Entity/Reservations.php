<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  


   

    #[ORM\ManyToOne(inversedBy: 'reservationss')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evenements $evenementss = null;


    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull(message: "Le CIN du citoyen ne peut pas être vide")]
    private ?int $CIN_cit = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;




   
    
      

      

    public function getId(): ?int
    {
        return $this->id;
    }

   

    

     

    public function getEvenementss(): ?evenements
    {
        return $this->evenementss;
    }

    public function setEvenementss(?evenements $s): self
    {
        $this->evenementss = $s;

        return $this;
   }

     public function getCINCit(): ?int
    {
        return $this->CIN_cit;
    }

    public function setCINCit(?int $CIN_cit): self
    {
        $this->CIN_cit = $CIN_cit;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }



   
   
}
