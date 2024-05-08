<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
class Evenements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
#[ORM\Column(length: 255)]
    private ?string $color = null;
   


    #[ORM\Column(type: Types::DATE_MUTABLE)]
   
   
    #[Assert\GreaterThan("now", message: "La date doit être postérieure à aujourd'hui")]
    private ?\DateTimeInterface $dateD = null;
   #[ORM\Column(type: Types::DATE_MUTABLE)]
   
   
    #[Assert\GreaterThan("now", message: "La date doit être postérieure à aujourd'hui")]
    private ?\DateTimeInterface $dateF = null;
    

   #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: "Le nom de l'événement ne peut pas être vide")]
    public ?string $nom_event = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: "La catégorie de l'événement ne peut pas être vide")]
    public ?string $categorie_evenet = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: "La description de l'événement ne peut pas être vide")]
    public ?string $description_event = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotNull(message: "Le nombre de places disponibles ne peut pas être vide")]
    public ?int $nbp_event = null;

     

    
    

    #[ORM\OneToMany(mappedBy: 'evenementss', targetEntity: Reservations::class, orphanRemoval: true)]
    private Collection $reservationss;

    

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->reservationss = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
     public function getNomEvent(): ?string
    {
        return $this->nom_event;
    }

    public function setNomEvent(?string $nom_event): self
    {
        $this->nom_event = $nom_event;

        return $this;
    }

    public function getCategorieEvenet(): ?string
    {
        return $this->categorie_evenet;
    }
public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function setCategorieEvenet(?string $categorie_evenet): self
    {
        $this->categorie_evenet = $categorie_evenet;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->description_event;
    }

    public function setDescriptionEvent(?string $description_event): self
    {
        $this->description_event = $description_event;

        return $this;
    }

    public function getNbpEvent(): ?int
    {
        return $this->nbp_event;
    }

    public function setNbpEvent(?int $nbp_event): self
    {
        $this->nbp_event = $nbp_event;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): self
    {
        $this->dateD = $dateD;

        return $this;
    }
    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(\DateTimeInterface $dateF): self
    {
        $this->dateF = $dateF;

        return $this;
    }
     
    

    

   

   

    

    



     
    /**
     * @return Collection<int, Reservations>
     */
    public function getReservationss(): Collection
    {
        return $this->reservationss;
    }

    public function addCReservationsontrat( $reservations): self
    {
        if (!$this->reservationss->contains($reservations)) {
            $this->reservationss->add($reservations);
            $reservations->setEvenementss($this);
        }

        return $this;
    }

    public function removeCReservationsontrat( $reservations): self
    {
        if ($this->reservationss->removeElement($reservations)) {
            // set the owning side to null (unless already changed)
            if ($reservations->getEvenementss() === $this) {
                $reservations->setEvenementss(null);
            }
        }

        return $this;
    }

    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
    
}
