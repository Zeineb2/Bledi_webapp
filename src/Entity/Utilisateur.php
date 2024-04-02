<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
/** 
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="CIN", columns={"CIN"})}, indexes={@ORM\Index(name="ID_muni", columns={"ID_muni"})})
 * @ORM\Entity
 */
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="CIN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    #[ORM\Id]
    #[ORM\Column(length: 10)]
    private ?int $cin; 

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $nom=null;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $email;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    #[ORM\Column]
    private ?int $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $adresse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rate", type="integer", nullable=true)
     */
    
    #[ORM\Column]
    private ?int $rate = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $pwd;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $role='citoyen';

    /**
     * @var string
     *
     * @ORM\Column(name="poste_ag", type="string", length=255, nullable=false, options={"default"="N.C"})
     */
    #[ORM\Column(length: 255)]
    private ?string $posteAg = 'N.C';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_muni", type="integer", nullable=true)
     */
    
    #[ORM\Column]
    private ?int $idMuni;

    public function getCin(): ?int
    {
        return $this->cin;
    }
    public function setCin(int $cin)
    {
        $this->cin = $cin;

        return $this;
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
