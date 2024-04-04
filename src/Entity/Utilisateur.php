<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;

use  Symfony\Component\Validator\Constraints as  Assert;
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
    #[Assert\NotBlank(message:'veuillez saisir votre CIN')]
    #[Assert\Length(min:8, max:8 ,minMessage:'minimum 8 chiffres',maxMessage:'maximum 8 chiffres')]
    private ?int $cin; 

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'veuillez saisir votre nom')]
    private ?string $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    #[Assert\Blank(message:'veuillez saisir votre adresse Email')]
    #[Assert\Email(message:'Email invalide')]
    private ?string $email=null;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    #[ORM\Column]
    #[Assert\NotBlank(message:'veuillez saisir votre numéro de téléphone')]
    #[Assert\Length(min:8)]
    private ?int $tel=null;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(message:'Email invalide')]
    private ?string $adresse=null;

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
    #[Assert\NotBlank]
    #[Assert\Email(message:'Email invalide')]
    private ?string $pwd=null;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    #[ORM\Column(length: 255)]
    private ?string $roles='citoyen';

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
    private ?int $idMuni=null;


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
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $this->pwd = $hashedPwd;
        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles)
    {
        $this->roles = $roles;

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
