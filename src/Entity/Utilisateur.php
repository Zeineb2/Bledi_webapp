<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class Utilisateur implements UserInterface
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $cin = null;

    
    #[ORM\Column(length: 255)]
    private ?string $nom ;

    
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

    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role= "ROLE_CITOYEN";

   
    #[ORM\Column(length: 255)]
    private ?string $posteAg = 'N.C';

  
    #[ORM\Column(length: 255)]
    private ?int $idMuni=0;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = 0;

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

   public function getUserIdentifier(): ?string
    {
        return $this->email; // Ou le champ que vous souhaitez utiliser comme identifiant utilisateur
    }

    public function getUsername(): ?string
    {
        return $this->email; // Ou le champ que vous souhaitez utiliser comme nom d'utilisateur
    }

    public function getRoles(): array
    {
        // Vous pouvez retourner un tableau contenant le rôle de l'utilisateur ici
        return [$this->role];
    }

    public function getPassword(): ?string
    {
        return $this->pwd;
    }
    public function setPassword(string $password)
    {
        // Hacher le mot de passe avant de le stocker dans la propriété
        $this->pwd = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getSalt(): ?string
    {
        // Cette méthode est nécessaire pour utiliser l'encodage de mot de passe salé
        // Vous pouvez laisser cette méthode vide si vous n'utilisez pas l'encodage de mot de passe salé
        return null;
    }

    public function eraseCredentials()
    {
        // Cette méthode est utilisée pour effacer les informations sensibles de l'utilisateur
        // Par exemple, les mots de passe en texte brut. Comme nous n'utilisons pas de texte brut,
        // cette méthode peut rester vide.
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }


}
