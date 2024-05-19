<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $marque = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $modele = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $couleur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $prixParJour = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Locations::class)]
    private Collection $locations;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: DommageVoiture::class)]
    private Collection $dommageVoitures;


    /**
     * @var Collection<int, ImageVoiture>
     */
    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: ImageVoiture::class, orphanRemoval: true, cascade:['persist'])]
    private Collection $imageVoitures;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?TypeVoiture $type = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->dommageVoitures = new ArrayCollection();
        $this->imageVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPrixParJour(): ?string
    {
        return $this->prixParJour;
    }

    public function setPrixParJour(?string $prixParJour): static
    {
        $this->prixParJour = $prixParJour;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Locations>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Locations $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Locations $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DommageVoiture>
     */
    public function getDommageVoitures(): Collection
    {
        return $this->dommageVoitures;
    }

    public function addDommageVoiture(DommageVoiture $dommageVoiture): static
    {
        if (!$this->dommageVoitures->contains($dommageVoiture)) {
            $this->dommageVoitures->add($dommageVoiture);
            $dommageVoiture->setVoiture($this);
        }

        return $this;
    }

    public function removeDommageVoiture(DommageVoiture $dommageVoiture): static
    {
        if ($this->dommageVoitures->removeElement($dommageVoiture)) {
            // set the owning side to null (unless already changed)
            if ($dommageVoiture->getVoiture() === $this) {
                $dommageVoiture->setVoiture(null);
            }
        }

        return $this;
    }

   
    /**
     * @return Collection<int, ImageVoiture>
     */
    public function getImageVoitures(): Collection
    {
        return $this->imageVoitures;
    }

    public function addImageVoiture(ImageVoiture $imageVoiture): static
    {
        if (!$this->imageVoitures->contains($imageVoiture)) {
            $this->imageVoitures->add($imageVoiture);
            $imageVoiture->setVoiture($this);
        }

        return $this;
    }

    public function removeImageVoiture(ImageVoiture $imageVoiture): static
    {
        if ($this->imageVoitures->removeElement($imageVoiture)) {
            // set the owning side to null (unless already changed)
            if ($imageVoiture->getVoiture() === $this) {
                $imageVoiture->setVoiture(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->marque . ' ' . $this->modele;
    }

    public function getType(): ?TypeVoiture
    {
        return $this->type;
    }

    public function setType(?TypeVoiture $type): static
    {
        $this->type = $type;

        return $this;
    }
}
