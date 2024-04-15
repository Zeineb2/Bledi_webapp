<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]

class Utilisateur
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $cin = null;

    
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    
    #[ORM\Column(length: 255)]
    private ?string $email;

    
    #[ORM\Column]
    private ?int $tel;

   
    #[ORM\Column(length: 255)]
    private ?string $adresse;

   
    #[ORM\Column]
    private ?int $rate = 0;

    #[ORM\Column(length: 255)]
    private ?string $pwd;

    
    #[ORM\Column(length: 255)]
    private ?string $role;

   
    #[ORM\Column(length: 255)]
    private ?string $posteAg = 'N.C';

  
    #[ORM\Column(length: 255)]
    private ?int $idMuni=null;

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel)
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    public function setPwd(string $pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    public function getPosteAg(): ?string
    {
        return $this->posteAg;
    }

    public function setPosteAg(string $posteAg)
    {
        $this->posteAg = $posteAg;

        return $this;
    }

    public function getIdMuni(): ?int
    {
        return $this->idMuni;
    }

    public function setIdMuni(?int $idMuni)
    {
        $this->idMuni = $idMuni;

        return $this;
    }


}
